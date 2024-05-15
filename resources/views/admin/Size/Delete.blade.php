@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletesize', ['SizeId' => $size->SizeId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên size:</label>
                <p class="form-control-static">{{ $size->SizeName }}</p>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <p class="form-control-static">{{ $size->SizeDescription }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('size') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop