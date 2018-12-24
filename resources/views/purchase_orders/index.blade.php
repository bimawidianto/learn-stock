@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Pengadaan</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Tanggal</th>
                                <th>Pemesan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchase_orders as $purchase_order)
                            <tr>
                                <td>{{ $purchase_order->ref }}</td>
                                <td>{{ $purchase_order->date->toDateString() }}</td>
                                <td>{{ $purchase_order->orderer }}</td>
                                <td>{{ ($purchase_order->received) ? 'Diterima' : 'Belum diterima' }}</td>
                                <td>
                                    <a href="{{ route('purchase_orders.show', [ $purchase_order->ref ]) }}" class="btn btn-default btn-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Belum ada pengadaan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer clearfix">
                    <a class="btn btn-default pull-right" href="{{ route('purchase_orders.create') }}" role="button">Tambah Pengadaan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
