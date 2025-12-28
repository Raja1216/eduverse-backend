<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentFailureController extends Controller
{
    public function __invoke(Request $request, PaymentRepositoryInterface $repo)
    {
        $payment = $repo->findByTxn($request->txnid);

        if ($payment) {
            $repo->update($payment, [
                'status' => 'failed',
                'gateway_response' => $request->all()
            ]);

            $payment->order->update([
                'payment_status' => 'failed'
            ]);
        }

        return response()->json(['message' => 'Payment failed']);
    }
}
