@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Penjualan</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Tanggal</th>
                                <th>Pembeli</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale_orders as $sale_order)
                            <tr>
                                <td>{{ $sale_order->ref }}</td>
                                <td>{{ $sale_order->date->toDateString() }}</td>
                                <td>{{ $sale_order->orderer }}</td>
                                <td>{{ ($sale_order->paid) ? 'Lunas' : 'Belum dibayar' }}</td>
                                <td>
                                    <a href="{{ route('sale_orders.show', [ $sale_order->ref ]) }}" class="btn btn-default btn-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Belum ada penjualan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default pull-right" href="{{ route('sale_orders.create') }}" role="button">Tambah Penjualan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
