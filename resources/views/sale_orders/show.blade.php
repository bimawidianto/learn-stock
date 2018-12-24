@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Penjualan</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Ref</th>
                                <td>{{ $sale_order->ref }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $sale_order->date->toDateString() }}</td>
                            </tr>
                            <tr>
                                <th>Pembeli</th>
                                <td>{{ $sale_order->orderer }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ ($sale_order->paid) ? 'Lunas' : 'Belum dibayar' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Nama Produk</th>
                                <th>Kuantiti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale_order->sale_items as $sale_item)
                            <tr>
                                <td>{{ $sale_item->product_sku }}</td>
                                <td>{{ $sale_item->product->name }}</td>
                                <td>{{ $sale_item->quantity }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Belum ada pengadaan produk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default" href="{{ route('sale_orders.index') }}" role="button">Daftar Penjualan</a>
                    <a class="btn btn-default" href="{{ route('sale_orders.sale_items.index', [ $sale_order->ref ]) }}" role="button">Daftar Penjualan Barang</a>
                    <a class="btn btn-default pull-right" href="{{ route('sale_orders.edit', [ $sale_order->ref ]) }}" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
