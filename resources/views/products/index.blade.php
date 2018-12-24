@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Produk</h3>
                </div>
                <div class="panel-body">
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
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <a href="{{ route('products.show', [ $product->sku ]) }}" class="btn btn-default btn-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Belum ada produk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default pull-right" href="{{ route('products.create') }}" role="button">Tambah</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
