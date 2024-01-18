<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function addPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $request->validate([
            'payment_method' => 'required|string',
            'amount'         => 'required|numeric',
        ]);

        $payment = new Payment([
            'payment_method' => $request->input('payment_method'),
            'amount'         => $request->input('amount'),
        ]);

        $order->payments()->save($payment);

        return response()->json($payment, Response::HTTP_CREATED);
    }

    public function removePayment($orderId, $paymentId)
    {
        $order = Order::findOrFail($orderId);

        $payment = Payment::findOrFail($paymentId);

        if ($payment->order_id !== $order->id) {
            return response()->json(['error' => 'O pagamento não pertence ao pedido.'], Response::HTTP_BAD_REQUEST);
        }

        $payment->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

