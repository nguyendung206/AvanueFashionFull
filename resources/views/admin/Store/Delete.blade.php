@extends('admin.layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletestore', ['StoreId' => $store->StoreId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên cửa hàng:</label>
                <p class="form-control-static">{{ $store->StoreName }}</p>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <p class="form-control-static">{{ $store->Phone }}</p>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <p class="form-control-static">{{ $store->Email }}</p>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <p class="form-control-static">{{ $store->Address }}</p>
            </div>
            <div class="form-group">
                <label>Website:</label>
                <p class="form-control-static">{{ $store->Website }}</p>
            </div>
            <div class="form-group">
                <label>Thời gian hoạt động:</label>
                <p class="form-control-static">{{ $store->TimeOnline }}</p>
            </div>
            <div class="form-group">
                <label>Thông tin thêm:</label>
                <p class="form-control-static">{{ $store->Information }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('store') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop