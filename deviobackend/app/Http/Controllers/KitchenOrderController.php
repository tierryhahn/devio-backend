<?php

namespace App\Http\Controllers;

use App\Models\KitchenOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KitchenOrderController extends Controller
{
    public function index()
    {
        $kitchenOrders = KitchenOrder::with('order.orderItems')->get();
        return response()->json($kitchenOrders, Response::HTTP_OK);
    }

    public function markAsComplete($id)
    {
        $kitchenOrder = KitchenOrder::findOrFail($id);
        $kitchenOrder->completed = true;
        $kitchenOrder->save();

        return response()->json($kitchenOrder, Response::HTTP_OK);
    }
}
