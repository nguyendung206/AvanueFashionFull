@extends('admin.layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletecategory', ['CategoryId' => $category->CategoryId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên loại hàng:</label>
                <p class="form-control-static">{{ $category->CategoryName }}</p>
            </div>
            <div class="form-group">
                <label>Loại hàng cha:</label>
                <p class="form-control-static">{{ $parentCategory->CategoryName ?? 'Không có' }}</p>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <p class="form-control-static">{{ $category->CategoryDescription }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('category') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop
