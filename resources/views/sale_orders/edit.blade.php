@extends('layout')

@section('title', 'Belajar Stok')
@section('navbar-brand', 'Belajar Stok')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" action="{{ route('sale_orders.update', [ $sale_order->ref ]) }}" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Penjualan</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ref</label>
                            <div class="col-sm-10">
                                <input name="ref" type="text" class="form-control" required value="{{ $sale_order->ref }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" required value="{{ $sale_order->date->toDateString() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pembeli</label>
                            <div class="col-sm-10">
                                <input name="orderer" type="text" class="form-control" required value="{{ $sale_order->orderer }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 checkbox">
                                <label>
                                    <input type="checkbox" name="paid" value="1" {{ ($sale_order->paid) ? 'checked disabled' : '' }}>
                                    Lunas
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <button type="submit" name="_method" value="PUT" class="btn btn-default pull-right">Simpan</button>
                        <button type="submit" name="_method" value="DELETE" class="btn btn-default">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
