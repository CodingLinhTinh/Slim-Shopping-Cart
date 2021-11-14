<?php
namespace Cart\Handlers;

use Cart\Handlers\Contracts\HandlerInterface;

class RecordFailedPayment implements HandlerInterface
{
    public function handle($event)
    {
        $event->order->payment()->create([
            'failed' => true
        ]);
}