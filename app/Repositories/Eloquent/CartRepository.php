<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Collection;

class CartRepository implements CartRepositoryInterface
{
    public function getUserCart(int $userId):Collection
    {
        return CartItem::where('user_id', $userId)->get();
    }

    public function findExisting(int $userId, string $type, int $itemId): ?CartItem
    {
        return CartItem::where([
            'user_id' => $userId,
            'item_type' => $type,
            'item_id' => $itemId
        ])->first();
    }

    public function add(array $data): CartItem
    {
        return CartItem::create($data);
    }

    public function update(CartItem $item, array $data): CartItem
    {
        $item->update($data);
        return $item;
    }

    public function remove(CartItem $item): void
    {
        $item->delete();
    }

    public function clear(int $userId): void
    {
        CartItem::where('user_id', $userId)->delete();
    }
}
