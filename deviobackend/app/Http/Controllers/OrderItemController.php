<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{

    public function addItem(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        $orderItem = new OrderItem([
            'product_id' => $product->id,
            'quantity'   => $request->input('quantity'),
        ]);

        $order->orderItems()->save($orderItem);

        return response()->json($orderItem, Response::HTTP_CREATED);
    }

    public function removeItem($orderId, $itemId)
    {
        $order = Order::findOrFail($orderId);

        $orderItem = OrderItem::findOrFail($itemId);

        if ($orderItem->order_id !== $order->id) {
            return response()->json(['error' => 'O item não pertence ao pedido.'], Response::HTTP_BAD_REQUEST);
        }

        $orderItem->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
