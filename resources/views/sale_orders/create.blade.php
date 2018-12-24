@extends('layout')

@section('title', 'Belajar Stock')
@section('navbar-brand', 'Belajar Stock')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" action="{{ route('sale_orders.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tambah Penjualan</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" required value="{{ old('date') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pembeli</label>
                            <div class="col-sm-10">
                                <input name="orderer" type="text" class="form-control" required value="{{ old('orderer') }}">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <button type="submit" class="btn btn-default pull-right">Tambah</button>
                        <a href="{{ route('sale_orders.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
