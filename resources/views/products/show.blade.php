@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Produk</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>SKU</th>
                                <td>{{ $product->sku }}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Kuantiti</th>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default" href="{{ route('products.index') }}" role="button">Daftar Produk</a>
                    <a class="btn btn-default pull-right" href="{{ route('products.edit', [ $product->sku ]) }}" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
