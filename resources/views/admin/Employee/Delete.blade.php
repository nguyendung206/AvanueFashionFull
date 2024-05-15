@extends('layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deleteemployee', ['EmployeeId' => $employee->EmployeeId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên nhân viên:</label>
                <p class="form-control-static">{{ $employee->FullName }}</p>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <p class="form-control-static">{{ $employee->Email }}</p>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <p class="form-control-static">{{ $employee->Phone }}</p>
            </div>
            <div class="form-group">
                <label>Đại chỉ:</label>
                <p class="form-control-static">{{ $employee->Address }}</p>
            </div>
            <div class="form-group">
                <label>Phân quyền:</label>
                @foreach($permisions as $item)
                @if($item->PermisionId == $employee->PermisionId)
                <p class="form-control-static">{{$item->PermisionName}}</p>
                @endif
                @endforeach
            </div>
            <div class="form-group">
                <label>Ảnh minh họa:</label>
                <div class="">
                    <input type="hidden" name="Photo" value="{{ $employee->Photo }}" />
                    <img id="Photo" src="/upload/employee/{{ $employee->Photo }}" class="img img-bordered" style="width:200px" />
                </div>
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