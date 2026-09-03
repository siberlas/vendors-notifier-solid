<?php

declare(strict_types=1);

namespace App\Notification;

use App\Entity\Order;
use App\Interface\NotificationChannelInterface;
use Psr\Log\LoggerInterface;

class LogNotificationChannel implements NotificationChannelInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function send(Order $order): void
    {
        $this->logger->info(
            sprintf(
                "[LOG] Notification envoyée à %s (%s) pour la commande #%d — %s (%.2f€)\n",
                $order->getVendor()->getName(),
                $order->getVendor()->getEmail(),
                $order->getId(),
                $order->getProductName(),
                $order->getPrice(),
            )
        );
    }
}
