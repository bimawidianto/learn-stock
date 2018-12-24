<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_orders = PurchaseOrder::all();

        return view('purchase_orders.index', [ 'purchase_orders' => $purchase_orders ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase_orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'orderer' => 'required|string'
        ]);

        $purchase_order = new PurchaseOrder;
        $purchase_order->ref = Carbon::now()->timestamp;
        $purchase_order->date = $request->date;
        $purchase_order->orderer = $request->orderer;
        $purchase_order->received = false;
        $purchase_order->save();

        return redirect()->route('purchase_orders.show', [ $purchase_order->ref ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_order = PurchaseOrder::find($id);

        return view('purchase_orders.show', [ 'purchase_order' => $purchase_order ]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase_order = PurchaseOrder::find($id);

        return view('purchase_orders.edit', [ 'purchase_order' => $purchase_order ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'date',
            'orderer' => 'string',
            'received' => 'boolean'
        ]);

        $purchase_order = PurchaseOrder::find($id);
        $purchase_order->date = $request->date;
        $purchase_order->orderer = $request->orderer;
        if($request->has('received')) {
            if (!$purchase_order->purchase_items()->exists()) {
                return back()->withErrors([
                    'received' => ['Tidak ada pengadaan produk']
                ])->withInput();
            }
            if (!$purchase_order->received && $request->received) {
                foreach($purchase_order->purchase_items as $purchase_item)
                {
                    $product = $purchase_item->product;
                    $product->quantity += $purchase_item->quantity;
                    $product->save();
                }
                $purchase_order->received = $request->received;
            }
        }    
        $purchase_order->save();

        return redirect()->route('purchase_orders.show', [ $purchase_order->ref ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseOrder::find($id)->delete();

        return redirect()->route('purchase_orders.index');
    }
}
