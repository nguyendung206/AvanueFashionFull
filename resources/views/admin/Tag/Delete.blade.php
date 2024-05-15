@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletetag', ['TagId' => $tag->TagId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên tag:</label>
                <p class="form-control-static">{{ $tag->TagName }}</p>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <p class="form-control-static">{{ $tag->TagDescription }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('tag') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop