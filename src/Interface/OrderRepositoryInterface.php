<?php

declare(strict_types=1);

namespace App\Interface;

use App\Entity\Order;
use App\Entity\Vendor;

interface OrderRepositoryInterface
{
    public function findVendorById(int $id): ?Vendor;

    public function save(Order $order): void;
}