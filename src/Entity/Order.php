<?php

declare(strict_types=1);

namespace App\Entity;

class Order
{
    private readonly string $status;
    private readonly \DateTimeImmutable $createdAt;

    public function __construct(
        private readonly int $id,
        private readonly Vendor $vendor,
        private readonly string $productName,
        private readonly float $price,
    ) {
        $this->status = 'pending';
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
