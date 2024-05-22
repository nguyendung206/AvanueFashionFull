@extends('admin.layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deleteproduct', ['ProductId' => $product->ProductId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên mặt hàng:</label>
                <p class="form-control-static">{{ $product->ProductName }}</p>
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <p class="form-control-static">{{ $product->Price }}</p>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <p class="form-control-static">{{ $product->ProductDescription }}</p>
            </div>
            <div class="form-group">
                <label>Ảnh minh họa:</label>
                <div class="">
                    <input type="hidden" name="Photo" value="{{ $product->ProductPhoto }}" />
                    <img id="Photo" src="/upload/{{ $product->ProductPhoto }}" class="img img-bordered" style="width:200px" />
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('product') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop