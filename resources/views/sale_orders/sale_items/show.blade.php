@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Penjualan Produk</h3>
                </div>
                <div class="panel-body">
                    <h4>Ref Penjualan: <a href="{{ route('sale_orders.show', [ $sale_order->ref ]) }}">{{ $sale_order->ref }}</a> <small>{{ $sale_order->date->toDateString() }}</small></h4>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>SKU</th>
                                <td>{{ $sale_item->product_sku }}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $sale_item->product->name }}</td>
                            </tr>
                            <tr>
                                <th>Kuantiti</th>
                                <td>{{ $sale_item->quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default" href="{{ route('sale_orders.sale_items.index', [ $sale_order->ref ]) }}" role="button">Daftar Penjualan Produk</a>
                    <a class="btn btn-default pull-right" href="{{ route('sale_orders.sale_items.edit', [ $sale_order->ref, $sale_item->id ]) }}" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
