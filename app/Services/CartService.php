<?php
namespace App\Services;

use App\Repositories\Contracts\CartRepositoryInterface;
use App\Models\Program;
use App\Models\Product;
use App\Models\Publication;
use App\Models\Event;
use App\Models\Assessment;
use Exception;

class CartService
{
    public function __construct(
        private CartRepositoryInterface $cartRepo
    ) {}

    public function getCart(int $userId)
    {
        return $this->cartRepo->getUserCart($userId);
    }

    public function addToCart(int $userId, array $data)
    {
        $existing = $this->cartRepo->findExisting(
            $userId,
            $data['item_type'],
            $data['item_id']
        );

        if ($existing) {
            throw new Exception('Item already exists in cart');
        }

        $payableAmount = $this->calculateAmount($data);

        return $this->cartRepo->add([
            'user_id' => $userId,
            'item_type' => $data['item_type'],
            'item_id' => $data['item_id'],
            'quantity' => $data['quantity'] ?? 1,
            'payment_option' => $data['payment_option'] ?? null,
            'payable_amount' => $payableAmount,
            'selected_color' => $data['selected_color'] ?? null,
            'selected_size' => $data['selected_size'] ?? null
        ]);
    }

    private function calculateAmount(array $data): float
    {
        return match ($data['item_type']) {
            'program' => $this->programAmount($data),
            'product' => Product::findOrFail($data['item_id'])->price * ($data['quantity'] ?? 1),
            'publication' => Publication::findOrFail($data['item_id'])->price,
            'event' => Event::findOrFail($data['item_id'])->price,
            'assessment' => Assessment::findOrFail($data['item_id'])->price,
            default => throw new Exception('Invalid item type')
        };
    }

    private function programAmount(array $data): float
    {
        $program = Program::findOrFail($data['item_id']);

        if ($data['payment_option'] === 'installment') {
            return $program->cost_per_month; // FIRST installment
        }

        return $program->selling_price;
    }

    public function removeFromCart(int $userId, int $cartItemId)
    {
        $item = $this->cartRepo->getUserCart($userId)
            ->where('id', $cartItemId)
            ->first();

        if (!$item) {
            throw new Exception('Cart item not found');
        }

        $this->cartRepo->remove($item);
    }

    public function clearCart(int $userId)
    {
        $this->cartRepo->clear($userId);
    }
}
