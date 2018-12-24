@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Pengadaan Produk</h3>
                </div>
                <div class="panel-body">
                    <h4>Ref Pengadaan: <a href="{{ route('purchase_orders.show', [ $purchase_order->ref ]) }}">{{ $purchase_order->ref }}</a> <small>{{ $purchase_order->received ? 'Diterima' : 'Belum diterima' }}</small></h4>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>SKU</th>
                                <td>{{ $purchase_item->product_sku }}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $purchase_item->product->name }}</td>
                            </tr>
                            <tr>
                                <th>Kuantiti</th>
                                <td>{{ $purchase_item->quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default" href="{{ route('purchase_orders.purchase_items.index', [ $purchase_order->ref ]) }}" role="button">Daftar Pengadaan Produk</a>
                    <a class="btn btn-default pull-right" href="{{ route('purchase_orders.purchase_items.edit', [ $purchase_order->ref, $purchase_item->id ]) }}" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
