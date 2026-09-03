<?php

declare(strict_types=1);

namespace Tests\Service;

use App\DTO\CreateOrderDTO;
use App\Entity\Vendor;
use App\Entity\Order;
use App\Service\OrderService;
use App\Interface\OrderRepositoryInterface;
use PHPUnit\Framework\TestCase;
use App\Service\NotificationService;
use PHPUnit\Framework\MockObject\MockObject;

class OrderServiceTest extends TestCase
{
    private OrderRepositoryInterface&MockObject $orderRepositoryMock;
    private NotificationService&MockObject $notificationServiceMock;
    private OrderService $orderService;

    protected function setUp(): void
    {
        $this->orderRepositoryMock = $this->createMock(OrderRepositoryInterface::class);
        $this->notificationServiceMock = $this->createMock(NotificationService::class);

        $this->orderService = new OrderService(
            $this->notificationServiceMock, 
            $this->orderRepositoryMock
        );
    }

    public function testCreateOrderSuccess(): void
    {
        $vendor = new Vendor(
            id: 1,
            name: 'vendorTest',
            email:'testVendor@gmail.com'
        );

        $this->orderRepositoryMock
            ->expects($this->once())
            ->method('findVendorById')
            ->with(1)
            ->willReturn($vendor);

        $this->orderRepositoryMock
            ->expects($this->once())
            ->method('save');
    
        $this->notificationServiceMock
            ->expects($this->once())
            ->method('notify');

        $orderDto = new CreateOrderDTO(
            vendorId: 1,
            productName: 'testK',
            price: 3,
        );

        $order = $this->orderService->createOrder($orderDto);

        $this->assertInstanceOf(Order::class, $order);
    }

    public function testCreateOrderThrowsIfVendorNotFound(): void
    {
        $this->orderRepositoryMock->method('findVendorById')
            ->with(1)
            ->willReturn(null);

        $this->expectException(\InvalidArgumentException::class);

        $this->notificationServiceMock
            ->expects($this->never())
            ->method('notify');
        
        $orderDto = new CreateOrderDTO(
            vendorId: 1,
            productName: 'testK',
            price: 3,
        );

        $this->orderService->createOrder($orderDto);
    }
}