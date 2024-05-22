@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savestore')}}" method="post">
            <input type="hidden" name="StoreId" value="{{$store->StoreId}}" />
            <div class="form-group">
                <label>Tên cửa hàng:</label>
                <input type="text" class="form-control" name="StoreName" value="{{$store->StoreName}}">
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" class="form-control" name="Phone" value="{{$store->Phone}}">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="Email" value="{{$store->Email}}">
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" class="form-control" name="Address" value="{{$store->Address}}">
            </div>
            <div class="form-group">
                <label>Website:</label>
                <input type="text" class="form-control" name="Website" value="{{$store->Website}}">
            </div>
            <div class="form-group">
                <label>Thời gian hoạt động:</label>
                <input type="text" class="form-control" name="TimeOnline" value="{{$store->TimeOnline}}">
            </div>
            <div class="form-group">
                <label>Thông tin thêm:</label>
                <input type="text" class="form-control" name="Information" value="{{$store->Information}}">
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