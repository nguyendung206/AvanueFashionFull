@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('saveemployee')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="EmployeeId" value="{{$employee->EmployeeId}}" />
            <input type="hidden" name="Password" value="{{$employee->Password}}" />
            <div class="form-group">
                <label>Tên nhân viên:</label>
                <input type="text" class="form-control" name="FullName" value="{{$employee->FullName}}">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="Email" value="{{$employee->Email}}">
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" class="form-control" name="Phone" value="{{$employee->Phone}}">
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="Address" value="{{$employee->Address}}">
            </div>
            <div class="form-group">
                <label>Phân quyền:</label>
                <select class="form-control" name="PermisionId">
                    <option value="0">-- Chọn quyền --</option>
                    @foreach($permisions as $item)
                    <option value="{{ $item->PermisionId }}" {{ $item->PermisionId == $employee->PermisionId ? 'selected' : '' }}>
                        {{ $item->PermisionName }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ảnh đại diện:</label>
                <input type="hidden" name="Photo" value="{{$employee->Photo}}" />
                <input type="file" class="form-control" name="uploadPhoto" onchange="document.getElementById('Photo').src = window.URL.createObjectURL(this.files[0])" />
            </div>
            <div class="form-group">
                <img id="Photo" src="/upload/employee/{{$employee->Photo}}" class="img img-bordered" style="width:200px" />
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('employee')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@stop();