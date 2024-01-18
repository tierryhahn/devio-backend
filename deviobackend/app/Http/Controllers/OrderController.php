<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\KitchenOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'payments', 'kitchenOrder')->get();
        return response()->json($orders, Response::HTTP_OK);
    }

    public function show($id)
    {
        $order = Order::with('orderItems', 'payments', 'kitchenOrder')->findOrFail($id);
        return response()->json($order, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    $request->validate([
        'customer_name' => 'required|string',
        'total'         => 'required|numeric',
        'change'        => 'required|numeric',
        'observation'   => 'nullable|string',
    ]);

    // Cria uma nova Order
    $order = Order::create($request->all());

    // Cria uma KitchenOrder associada à Order
    $kitchenOrder = new KitchenOrder();
    $order->kitchenOrder()->save($kitchenOrder);

    return response()->json($order, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_name' => 'sometimes|string',
            'total'         => 'sometimes|numeric',
            'change'        => 'sometimes|numeric',
            'observation'   => 'sometimes|string',
        ]);

        $order->update($request->all());

        return response()->json($order, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}