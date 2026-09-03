<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CreateOrderDTO;
use App\Entity\Order;
use App\Interface\OrderRepositoryInterface;
class OrderService
{
    public function __construct(
        private readonly NotificationService $notifier,
        private readonly OrderRepositoryInterface $inMemory,
    ){}

    public function createOrder(CreateOrderDTO $dto): Order
    {
        $vendor = $this->inMemory->findVendorById($dto->vendorId);

        if($vendor === null) {
            throw new \InvalidArgumentException(
                sprintf('Vendor avec l\'id %d introuvable', $dto->vendorId)
            );
        }

        $order = new Order(
            id: (int)uniqid(),
            vendor: $vendor,
            productName: $dto->productName,
            price: $dto->price,
        );

        $this->inMemory->save($order);
        $this->notifier->notify($order);

        return $order;
    }
}