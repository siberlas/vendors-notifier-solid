<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Interface\NotificationChannelInterface;

class NotificationService
{
    /**
     * @param iterable<NotificationChannelInterface> $channels
     */
    public function __construct(
        private readonly iterable $channels,
    ){}

    public function notify(Order $order): void
    {
        foreach($this->channels as $channel) {
            $channel->send($order);
        }
    }
}