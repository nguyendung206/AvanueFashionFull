@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savetag')}}" method="post">
            <input type="hidden" name="TagId" value="{{$tag->TagId}}" />
            <div class="form-group">
                <label>Tên tag:</label>
                <input type="text" class="form-control" name="TagName" value="{{$tag->TagName}}">
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <input type="text" class="form-control" name="TagDescription" value="{{$tag->TagDescription}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('tag')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();