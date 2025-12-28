<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Str;

class PayUService
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepo
    ) {}

    public function initiatePayment(Order $order)
    {
        $txnId = 'TXN_' . strtoupper(Str::random(10));

        $payment = $this->paymentRepo->create([
            'order_id' => $order->id,
            'transaction_id' => $txnId,
            'amount' => $order->total_amount,
            'status' => 'initiated'
        ]);

        $data = [
            'key' => config('services.payu.key'),
            'txnid' => $txnId,
            'amount' => $order->total_amount,
            'productinfo' => 'Order #' . $order->order_code,
            'firstname' => $order->user->name,
            'email' => $order->user->email,
            'phone' => $order->user->phone,
            'surl' => config('services.payu.success'),
            'furl' => config('services.payu.failure'),
        ];

        $data['hash'] = $this->generateHash($data);

        return [
            'action' => config('services.payu.url'),
            'params' => $data
        ];
    }

    private function generateHash(array $data): string
    {
        $salt = config('services.payu.salt');

        $hashString = implode('|', [
            $data['key'],
            $data['txnid'],
            $data['amount'],
            $data['productinfo'],
            $data['firstname'],
            $data['email'],
            '', '', '', '', '', '', '', '', ''
        ]) . '|' . $salt;

        return strtolower(hash('sha512', $hashString));
    }
}
