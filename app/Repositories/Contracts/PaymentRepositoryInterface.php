<?php

namespace App\Repositories\Contracts;

use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function create(array $data): Payment;
    public function update(Payment $payment, array $data): Payment;
    public function findByTxn(string $txnId): ?Payment;
}
