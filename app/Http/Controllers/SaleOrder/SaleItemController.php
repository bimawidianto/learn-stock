<?php

namespace App\Http\Controllers\SaleOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SaleOrder;
use App\SaleItem;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sale_order_ref)
    {
        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_items = $sale_order->sale_items;

        return view('sale_orders.sale_items.index', [
            'sale_order' => $sale_order,
            'sale_items' => $sale_items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sale_order_ref)
    {
        $sale_order = SaleOrder::find($sale_order_ref);

        return view('sale_orders.sale_items.create', [
            'sale_order' => $sale_order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sale_order_ref)
    {
        $this->validate($request, [
            'product_sku' => 'required|string|exists:products,sku',
            'quantity' => 'required|numeric'           
        ]);

        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_item = new SaleItem;
        $sale_item->product_sku = $request->product_sku;
        $sale_item->quantity = $request->quantity;
        $sale_order->sale_items()->save($sale_item);

        return redirect()->route('sale_orders.sale_items.index', [
            $sale_order_ref
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sale_order_ref, $id)
    {
        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_item = $sale_order->sale_items()->find($id);

        return view('sale_orders.sale_items.show', [
            'sale_order' => $sale_order,
            'sale_item' => $sale_item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sale_order_ref, $id)
    {
        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_item = $sale_order->sale_items()->find($id);

        return view('sale_orders.sale_items.edit', [
            'sale_order' => $sale_order,
            'sale_item' => $sale_item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sale_order_ref, $id)
    {
        $this->validate($request, [
            'product_sku' => 'string|exists:products,sku',
            'quantity' => 'numeric'           
        ]);

        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_item = $sale_order->sale_items()->find($id);
        $sale_item->product_sku = $request->product_sku;
        $sale_item->quantity = $request->quantity;
        $sale_order->sale_items()->save($sale_item);

        return redirect()->route('sale_orders.sale_items.index', [
            $sale_order_ref
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sale_order_ref, $id)
    {
        $sale_order = SaleOrder::find($sale_order_ref);
        $sale_item = $sale_order->sale_items()->find($id)->delete();

        return redirect()->route('sale_orders.sale_items.index', [
            $sale_order_ref
        ]);
    }
}
