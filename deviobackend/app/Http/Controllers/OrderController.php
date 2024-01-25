<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\KitchenOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product', 'payments', 'kitchenOrder')->get();
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
        'code'          => 'nullable|string',
    ]);

    $order = Order::create($request->all());

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
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $orderItems = $order->orderItems;

            foreach ($orderItems as $orderItem) {
                $orderItem->delete();
            }
            $order->delete();

            DB::commit();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao excluir a ordem.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}