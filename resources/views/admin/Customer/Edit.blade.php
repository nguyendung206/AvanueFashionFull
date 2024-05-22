@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savecustomer')}}" method="post">
            <input type="hidden" name="CustomerId" value="{{$customer->CustomerId}}" />
            <div class="form-group">
                <label>Tên khách hàng:</label>
                <input type="text" class="form-control" name="CustomerName" value="{{$customer->CustomerName}}">
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" class="form-control" name="Phone" value="{{$customer->Phone}}">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="Email" value="{{$customer->Email}}">
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" class="form-control" name="Address" value="{{$customer->Address}}">
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" class="form-control" name="Password" value="{{$customer->Password}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('customer')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();