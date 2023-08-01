<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json('Not found', 404);
        }
        return response()->json($order, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOrderRequest $request, string $id)
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json('Not found', 404);
        }
        $order->update($request->validated());
        // $order->update($request->all());
       
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json('Not found', 404);
        }
        $order->delete();
            return response()->json('', 204);
    }
}
