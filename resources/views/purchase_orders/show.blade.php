@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Pengadaan</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Ref</th>
                                <td>{{ $purchase_order->ref }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $purchase_order->date->toDateString() }}</td>
                            </tr>
                            <tr>
                                <th>Pemesan</th>
                                <td>{{ $purchase_order->orderer }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ ($purchase_order->received) ? 'Diterima' : 'Belum diterima' }}</td>
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
                            @forelse ($purchase_order->purchase_items as $purchase_item)
                            <tr>
                                <td>{{ $purchase_item->product_sku }}</td>
                                <td>{{ $purchase_item->product->name }}</td>
                                <td>{{ $purchase_item->quantity }}</td>
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
                    <a class="btn btn-default" href="{{ route('purchase_orders.index') }}" role="button">Daftar Pengadaan</a>
                    <a class="btn btn-default" href="{{ route('purchase_orders.purchase_items.index', [ $purchase_order->ref ]) }}" role="button">Daftar Pengadaan Barang</a>
                    <a class="btn btn-default pull-right" href="{{ route('purchase_orders.edit', [ $purchase_order->ref ]) }}" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
