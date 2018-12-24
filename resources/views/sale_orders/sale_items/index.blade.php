@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Penjualan Barang</h3>
                </div>
                <div class="panel-body">
                    <h4>Ref Penjualan: <a href="{{ route('sale_orders.show', [ $sale_order->ref ]) }}">{{ $sale_order->ref }}</a> <small>{{ $sale_order->date->toDateString() }}</small></h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Nama Produk</th>
                                <th>Kuantiti</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale_items as $sale_item)
                            <tr>
                                <td>{{ $sale_item->product_sku }}</td>
                                <td>{{ $sale_item->product->name }}</td>
                                <td>{{ $sale_item->quantity }}</td>
                                <td>
                                    <a href="{{ route('sale_orders.sale_items.show', [ $sale_order->ref, $sale_item->id ]) }}" class="btn btn-default btn-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Belum ada pengadaan produk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default pull-right" href="{{ route('sale_orders.sale_items.create', [ $sale_order->ref ]) }}" role="button">Tambah Penjualan Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
