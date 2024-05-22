@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savesize')}}" method="post">
            <input type="hidden" name="SizeId" value="{{$size->SizeId}}" />
            <div class="form-group">
                <label>Tên size:</label>
                <input type="text" class="form-control" name="SizeName" value="{{$size->SizeName}}">
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <input type="text" class="form-control" name="SizeDescription" value="{{$size->SizeDescription}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('size')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();