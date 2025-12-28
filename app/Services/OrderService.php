<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Str;
use Exception;

class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepo,
        private CartRepositoryInterface $cartRepo
    ) {}

    public function createOrder(int $userId, array $payload)
    {
        $cartItems = $this->cartRepo->getUserCart($userId);

        if ($cartItems->isEmpty()) {
            throw new Exception('Cart is empty');
        }

        $total = $cartItems->sum('payable_amount');

        $paymentType = $cartItems->contains(
            fn ($item) => $item->payment_option === 'installment'
        ) ? 'installment' : 'full';

        $order = $this->orderRepo->create([
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => $userId,
            'total_amount' => $total,
            'payment_type' => $paymentType,
            'shipping_address' => $payload['shipping_address'] ?? null,
            'billing_address' => $payload['billing_address'] ?? null
        ]);

        $orderItems = $cartItems->map(fn ($item) => [
            'item_type' => $item->item_type,
            'item_id' => $item->item_id,
            'item_name' => strtoupper($item->item_type) . ' #' . $item->item_id,
            'price' => $item->payable_amount,
            'quantity' => $item->quantity,
            'payment_option' => $item->payment_option
        ])->toArray();

        $this->orderRepo->addItems($order, $orderItems);

        // Clear cart after order
        $this->cartRepo->clear($userId);

        return $order->load('items');
    }

    public function listOrders(int $userId)
    {
        return $this->orderRepo->getUserOrders($userId);
    }

    public function getOrder(int $userId, int $orderId)
    {
        $order = $this->orderRepo->findUserOrder($userId, $orderId);

        if (!$order) {
            throw new Exception('Order not found');
        }

        return $order;
    }
}
