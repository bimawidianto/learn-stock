@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" action="{{ route('sale_orders.sale_items.store', [ $sale_order->ref ]) }}" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tambah Penjualan Produk</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <h4>Ref Penjualan: <a href="{{ route('sale_orders.show', [ $sale_order->ref ]) }}">{{ $sale_order->ref }}</a> <small>{{ $sale_order->date->toDateString() }}</small></h4>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Produk</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="product_sku" required>
                                    <option value=""></option>
                                    @foreach (App\Product::whereNotIn('sku', $sale_order->sale_items->pluck('product_sku'))->get() as $product)
                                    <option value="{{ $product->sku }}">{{ $product->sku }} - {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kuantiti</label>
                            <div class="col-sm-10">
                                <input name="quantity" type="number" class="form-control" required value="{{ old('quantity') }}">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <button type="submit" class="btn btn-default pull-right">Tambah</button>
                        <a href="{{ route('sale_orders.sale_items.index', [ $sale_order->ref ]) }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
