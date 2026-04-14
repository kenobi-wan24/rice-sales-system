<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RiceItem;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('riceItem')->latest()->get();
        return view ('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riceItems = RiceItem::all();
        return view ('orders.create', compact('riceItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rice_item_id' => 'required|exists:rice_items,id',
            'quantity_kg' => 'required|numeric|min:0.01',
        ]);

        $riceItem = RiceItem::findOrFail($request->rice_item_id);
        $totalCost = $request->quantity_kg * $riceItem->price_per_kg;

        Order::create([
            'rice_item_id' => $request->rice_item_id,
            'quantity_kg' => $request->quantity_kg,
            'total_cost' => $totalCost,
        ]);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('riceItem', 'payment');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
