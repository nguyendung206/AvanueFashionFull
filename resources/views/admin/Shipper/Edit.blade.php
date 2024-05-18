@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('saveshipper')}}" method="post">
            <input type="hidden" name="ShipperId" value="{{$shipper->ShipperId}}" />
            <div class="form-group">
                <label>Tên người giao hàng:</label>
                <input type="text" class="form-control" name="ShipperName" value="{{$shipper->ShipperName}}">
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" class="form-control" name="Phone" value="{{$shipper->Phone}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('shipper')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();