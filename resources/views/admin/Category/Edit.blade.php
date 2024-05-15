@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('savecategory')}}" method="post">
            <input type="hidden" name="CategoryId" value="{{$category->CategoryId}}" />
            <div class="form-group">
                <label>Tên loại hàng:</label>
                <input type="text" class="form-control" name="CategoryName" value="{{$category->CategoryName}}">
            </div>
            <div class="form-group">
                <label>Loại hàng cha:</label>
                <select class="form-control" name="ParentId">
                    <option value="0">-- Loại hàng --</option>
                    @foreach($categorylist as $item)
                    <option value="{{ $item->CategoryId }}" {{ $item->CategoryId == $category->ParentId ? 'selected' : '' }}>
                        {{ $item->CategoryName }}
                    </option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <input type="text" class="form-control" name="CategoryDescription" value="{{$category->CategoryDescription}}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('category')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();