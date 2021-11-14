<?php

use Cart\Basket\Basket;
use Cart\Models\Address;
use Cart\Models\Customer;
use Cart\Models\Order;
use Cart\Models\Payment;
use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;
use Cart\Support\Storage\SessionStorage;
use Cart\Validation\Contracts\ValidatorInterface;
use Cart\Validation\Validator;

use Psr\Container\ContainerInterface;

use RandomLib\Factory;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use function DI\get;

return [
    RouterInterface::class => function (ContainerInterface $c) { 
        return $c->get('router');
    },

    Factory::class => function (ContainerInterface $c)
    {
        return new RandomLib\Factory;
    },

    ValidatorInterface::class => function (ContainerInterface $c)
    {
        return new Validator;
    },

    StorageInterface::class => function (ContainerInterface $c) {
        return new SessionStorage('cart');
    },

    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('basket', $c->get(Basket::class));

        return $twig;
    },

    Product::class => function (ContainerInterface $c) {
        return new Product;
    },

    Order::class => function (ContainerInterface $c) {
        return new Order;
    },

    Customer::class => function (ContainerInterface $c) {
        return new Customer;
    },

    Address::class => function (ContainerInterface $c) {
        return new Address;
    },

    Payment::class => function (ContainerInterface $c) {
        return new Payment;
    },

    Basket::class => function (ContainerInterface $c) {
        return new Basket(
            $c->get(StorageInterface::class),
            $c->get(Product::class)
        );
    }
];