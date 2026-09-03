<?php

declare(strict_types=1);

namespace App\Notification;

use App\Entity\Order;
use App\Interface\NotificationChannelInterface;

class EmailNotificationChannel implements NotificationChannelInterface
{
    public function send(Order $order): void
    {
        echo sprintf(
            "[EMAIL] Notification envoyée à %s (%s) pour la commande #%d — %s (%.2f€)\n",
            $order->getVendor()->getName(),
            $order->getVendor()->getEmail(),
            $order->getId(),
            $order->getProductName(),
            $order->getPrice(),
        );
    }
}
