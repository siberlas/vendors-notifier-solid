<?php

declare(strict_types=1);

namespace App\DTO;

class CreateOrderDTO
{
    public function __construct(
        public readonly int $vendorId,
        public readonly string $productName,
        public readonly float $price,
    ){}
}