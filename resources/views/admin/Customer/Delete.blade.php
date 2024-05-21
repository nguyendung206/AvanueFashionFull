@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletecustomer', ['CustomerId' => $customer->CustomerId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên khách hàng:</label>
                <p class="form-control-static">{{ $customer->CustomerName }}</p>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <p class="form-control-static">{{ $customer->Phone }}</p>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <p class="form-control-static">{{ $customer->Email }}</p>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <p class="form-control-static">{{ $customer->Address }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('customer') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>

    </div>
</div>
@stop