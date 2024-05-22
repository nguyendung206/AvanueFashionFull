@extends('admin.layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletecolor', ['ColorId' => $color->ColorId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Tên màu:</label>
                <p class="form-control-static">{{ $color->ColorName }}</p>
            </div>
            <div class="form-group">
                <label>Màu minh họa:</label>
                <p class="form-control-static" style="background-color: <?php echo $color->ColorIllustration; ?>;"></p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('color') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop