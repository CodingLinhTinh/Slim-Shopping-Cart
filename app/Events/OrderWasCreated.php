<?php
namespace Cart\Events;

use Cart\Basket\Basket;
use Cart\Models\Order;

class OrderWasCreated extends Event
{
    public $order;
    public $basket;

    public function __construct(Order $order, Basket $basket)
    {
        $this->order = $order;
        $this->basket = $basket;
    }

    
}