<?php

declare(strict_types=1);

namespace App\Interface;

use App\Entity\Order;

interface NotificationChannelInterface
{
    public function send(Order $order): void;
}
