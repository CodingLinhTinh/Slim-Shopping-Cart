<?php

namespace Cart\Controllers;

use Cart\Basket\Basket;
use Cart\Events\OrderWasCreated;
use Cart\Handlers\EmptyBasket;
use Cart\Handlers\MarkOrderPaid;
use Cart\Handlers\RecordFailedPayment;
use Cart\Handlers\RecordSuccessfulPayment;
use Cart\Handlers\UpdateStock;
use Cart\Models\Address;
use Cart\Models\Customer;
use Cart\Models\Order;
use Cart\Models\Product;
use Cart\Validation\Contracts\ValidatorInterface;
use Cart\Validation\Forms\OrderForm;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use RandomLib\Factory as RandomGenerator;

use Slim\Router;
use Slim\Views\Twig;

use Braintree_Transaction;

class OrderController
{
    protected $basket;
    protected $router;
    protected $validator;

    public function __construct(Basket $basket, Router $router, ValidatorInterface $validator)
    {
        $this->basket = $basket;
        $this->router = $router;
        $this->validator = $validator;
    }

    public function index(Request $request, Response $response, Twig $view, Product $product)
    {
        $this->basket->refresh();

        if (! $this->basket->subTotal()) {
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $view->render($response, 'order/index.twig');
    }

    public function create(Request $request, Response $response, Customer $customer, Address $address,  RandomGenerator $randomGenerator)
    {
        $this->basket->refresh();

        if (! $this->basket->subTotal()) {
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        if (! $request->getParam('payment_method_nonce')) {
            return $response->withRedirect($this->router->pathFor('order.index'));
        }

        $validation = $this->validator->validate($request, OrderForm::rules());

        if ($validation->fails()) {
            return $response->withRedirect($this->router->pathFor('order.index'));
        }

        $customer = $customer->firstOrCreate([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
        ]);

        $address = $address->firstOrCreate([
            'address1' => $request->getParam('address1'),
            'address2' => $request->getParam('address2'),
            'city' => $request->getParam('city'),
            'postal_code' => $request->getParam('postal_code'),
        ]);

        $hash = $randomGenerator->getMediumStrengthGenerator()->generateString(
            32, '0123456789abcdefghijklmnopqrstuvwxyz'
        );

        $order = $customer->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => $this->basket->subTotal() + 5,
            'address_id' => $address->id
        ]);

        $items = $this->basket->all();

        $order->products()->saveMany(
            $items,
            $this->getQuantities($items)
        );

        $result = \Braintree_Transaction::sale([
            'amount' => $this->basket->subTotal() + 5,
            'paymentMethodNonce' => $request->getParam('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $event = new OrderWasCreated($order, $this->basket);

        if (! $result->success) {
            $event->attach(new RecordFailedPayment);
            $event->dispatch();

            return $response->withRedirect($this->router->pathFor('order.index'));
        }

        $event->attach([
            new MarkOrderPaid,
            new RecordSuccessfulPayment($result->transaction->id),
            new UpdateStock,
            new EmptyBasket
        ]);

        $event->dispatch();

        return $response->withRedirect($this->router->pathFor('order.show', ['hash' => $hash]));

    }

    public function show($hash, Request $request, Response $response, Twig $view, Order $order)
    {
        $order = $order->with(['address', 'products'])
            ->where('hash', $hash)
            ->first();

        if (! $order) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $view->render($response, 'order/show.twig', [
            'order' => $order
        ]);
    }

    protected function getQuantities($items)
    {
        $quantities = [];

        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}