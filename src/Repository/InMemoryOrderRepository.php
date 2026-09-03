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

    public function __construct()
    {
        $this->vendors = [
            1 => new Vendor(1, 'Alice Diallo', 'alice@tobili.com'),
            2 => new Vendor(2,'Bob Koné', 'bob@tobili.com'),
        ];
    }


    public function findVendorById(int $id): ?Vendor
    {
        return $this->vendors[$id] ?? null;
    }

    public function save(Order $order): void
    {
        $this->orders[$order->getId()] = $order;
    }
}