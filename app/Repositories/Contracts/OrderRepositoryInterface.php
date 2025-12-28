<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function create(array $data): Order;
    public function addItems(Order $order, array $items): void;
    public function getUserOrders(int $userId);
    public function findUserOrder(int $userId, int $orderId): ?Order;
}
