<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Vendor;
use App\Interface\OrderRepositoryInterface;

class InMemoryOrderRepository implements OrderRepositoryInterface
{
    private array $vendors;
    private array $orders = [];


    public function findVendorById(int $id): ?Vendor
    {
        return $this->vendors[$id] ?? null;
    }

    public function save(Order $order): void
    {
        $this->orders[$order->getId()] = $order;
    }
}