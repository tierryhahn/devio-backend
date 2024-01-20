<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'code'       => 'required|string|unique:products',
            'price'      => 'required|numeric',
            'category'   => 'required|string|in:Combos,Acompanhamentos,Bebidas,Sobremesas',
            'description'=> 'nullable|string',
            'image'      => 'nullable|string',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name'        => 'sometimes|string',
            'code'        => 'sometimes|string|unique:products,code,' . $id,
            'price'       => 'sometimes|numeric',
            'category'    => 'sometimes|string|in:Combos,acompanhamentos,Bebidas,sobremesas',
            'description' => 'sometimes|string', 
            'image'       => 'sometimes|url',     
        ]);

        $product->update($validatedData);

        return response()->json($product, Response::HTTP_OK);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
