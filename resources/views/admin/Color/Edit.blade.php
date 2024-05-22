@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savecolor')}}" method="post">
            <input type="hidden" name="ColorId" value="{{$color->ColorId}}" />
            <div class="form-group">
                <label>Tên màu:</label>
                <input type="text" class="form-control" name="ColorName" value="{{$color->ColorName}}">
            </div>
            <div class="form-group">
                <label>Màu mình họa:</label>
                <input type="text" class="form-control" name="ColorIllustration" value="{{$color->ColorIllustration}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('color')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();