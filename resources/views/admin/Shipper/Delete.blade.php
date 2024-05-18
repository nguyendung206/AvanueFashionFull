@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deleteshipper', ['ShipperId' => $shipper->ShipperId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên người giao hàng:</label>
                <p class="form-control-static">{{ $shipper->ShipperName }}</p>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <p class="form-control-static">{{ $shipper->Phone }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('shipper') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop