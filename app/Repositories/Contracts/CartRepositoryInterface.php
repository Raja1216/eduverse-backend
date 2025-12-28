<?php

namespace App\Repositories\Contracts;

use App\Models\CartItem;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function getUserCart(int $userId): Collection;
    public function findExisting(int $userId, string $type, int $itemId): ?CartItem;
    public function add(array $data): CartItem;
    public function update(CartItem $item, array $data): CartItem;
    public function remove(CartItem $item): void;
    public function clear(int $userId): void;
}
