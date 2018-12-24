<?php

namespace App\Http\Controllers\PurchaseOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchaseOrder;
use App\PurchaseItem;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($purchase_order_ref)
    {
        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_items = $purchase_order->purchase_items;

        return view('purchase_orders.purchase_items.index', [
            'purchase_order' => $purchase_order,
            'purchase_items' => $purchase_items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($purchase_order_ref)
    {
        $purchase_order = PurchaseOrder::find($purchase_order_ref);

        return view('purchase_orders.purchase_items.create', [
            'purchase_order' => $purchase_order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $purchase_order_ref)
    {
        $this->validate($request, [
            'product_sku' => 'required|string|exists:products,sku',
            'quantity' => 'required|numeric'           
        ]);

        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_item = new PurchaseItem;
        $purchase_item->product_sku = $request->product_sku;
        $purchase_item->quantity = $request->quantity;
        $purchase_order->purchase_items()->save($purchase_item);

        return redirect()->route('purchase_orders.purchase_items.index', [
            $purchase_order_ref
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($purchase_order_ref, $id)
    {
        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_item = $purchase_order->purchase_items()->find($id);

        return view('purchase_orders.purchase_items.show', [
            'purchase_order' => $purchase_order,
            'purchase_item' => $purchase_item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_order_ref, $id)
    {
        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_item = $purchase_order->purchase_items()->find($id);

        return view('purchase_orders.purchase_items.edit', [
            'purchase_order' => $purchase_order,
            'purchase_item' => $purchase_item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase_order_ref, $id)
    {
        $this->validate($request, [
            'product_sku' => 'string|exists:products,sku',
            'quantity' => 'numeric'           
        ]);

        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_item = $purchase_order->purchase_items()->find($id);
        $purchase_item->product_sku = $request->product_sku;
        $purchase_item->quantity = $request->quantity;
        $purchase_order->purchase_items()->save($purchase_item);

        return redirect()->route('purchase_orders.purchase_items.index', [
            $purchase_order_ref
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchase_order_ref, $id)
    {
        $purchase_order = PurchaseOrder::find($purchase_order_ref);
        $purchase_item = $purchase_order->purchase_items()->find($id)->delete();

        return redirect()->route('purchase_orders.purchase_items.index', [
            $purchase_order_ref
        ]);
    }
}
