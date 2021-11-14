<?php
namespace Cart\Handlers;

use Cart\Handlers\Contracts\HandlerInterface;

class MarkOrderPaid implements HandlerInterface
{
    public function handle($event)
    {
        $event->order->update([
            'paid' => true
        ]);
    }
}