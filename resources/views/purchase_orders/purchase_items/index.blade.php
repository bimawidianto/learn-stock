@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Pengadaan Barang</h3>
                </div>
                <div class="panel-body">
                    <h4>Ref Pengadaan: <a href="{{ route('purchase_orders.show', [ $purchase_order->ref ]) }}">{{ $purchase_order->ref }}</a> <small>{{ $purchase_order->received ? 'Diterima' : 'Belum diterima' }}</small></h4>
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
                            @forelse ($purchase_items as $purchase_item)
                            <tr>
                                <td>{{ $purchase_item->product_sku }}</td>
                                <td>{{ $purchase_item->product->name }}</td>
                                <td>{{ $purchase_item->quantity }}</td>
                                <td>
                                    <a href="{{ route('purchase_orders.purchase_items.show', [ $purchase_order->ref, $purchase_item->id ]) }}" class="btn btn-default btn-xs">Detail</a>
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
                    <a class="btn btn-default pull-right" href="{{ route('purchase_orders.purchase_items.create', [ $purchase_order->ref ]) }}" role="button">Tambah Pengadaan Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
