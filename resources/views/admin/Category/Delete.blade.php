@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deleteemployee', ['EmployeeId' => $category->EmployeeId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên nhân viên:</label>
                <p class="form-control-static">{{ $category->CategoryName }}</p>
            </div>
            <div class="form-group">
                <label>Loại hàng cha:</label>
                @foreach($categorylist as $item)
                @if($item->CategoryId == $category->ParentId)
                <p class="form-control-static">{{$item->CategoryName}}</p>
                @endif
                @endforeach
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
                <a href="{{ route('employee') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop