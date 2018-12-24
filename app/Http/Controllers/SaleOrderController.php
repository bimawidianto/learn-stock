<?php

namespace App\Http\Controllers;

use App\SaleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_orders = SaleOrder::all();

        return view('sale_orders.index', [ 'sale_orders' => $sale_orders ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale_orders.create');
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

        $sale_order = new SaleOrder;
        $sale_order->ref = Carbon::now()->timestamp;
        $sale_order->date = $request->date;
        $sale_order->orderer = $request->orderer;
        $sale_order->paid = false;
        $sale_order->save();

        return redirect()->route('sale_orders.show', [ $sale_order->ref ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale_order = SaleOrder::find($id);

        return view('sale_orders.show', ['sale_order' => $sale_order ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale_order = SaleOrder::find($id);

        return view('sale_orders.edit', [ 'sale_order' => $sale_order ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'date',
            'orderer' => 'string',
            'paid' => 'boolean'
        ]);

        $sale_order = SaleOrder::find($id);
        $sale_order->date = $request->date;
        $sale_order->orderer = $request->orderer;
        if($request->has('paid')) {
            if (!$sale_order->sale_items()->exists()) {
                return back()->withErrors([
                    'paid' => ['Tidak ada penjualan produk']
                ])->withInput();
            }
            if (!$sale_order->paid && $request->paid) {
                foreach($sale_order->sale_items as $sale_item)
                {
                    $product = $sale_item->product;
                    $product->quantity -= $sale_item->quantity;
                    $product->save();
                }
                $sale_order->paid = $request->paid;
            }
        }    
        $sale_order->save();

        return redirect()->route('sale_orders.show', [ $sale_order->ref ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaleOrder::find($id)->delete();

        return redirect()->route('sale.orders.index');
    }
}
