@extends('admin.layouts.admin')
@section('main')
<div class="box box-danger">
    <div class="box-body">
        <form action="{{ route('deletesaleoff', ['SaleOffId' => $saleoff->SaleOffId]) }}" method="post">
            @csrf
            <div class="form-group">
                <label>Loại khuyến mãi:</label>
                <p class="form-control-static">{{ $saleoff->Type }}</p>
            </div>
            <div class="form-group">
                <label>Giá trị:</label>
                <p class="form-control-static">{{ $saleoff->DiscountPrice }}</p>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i>
                    Xác nhận xóa
                </button>
                <a href="{{ route('saleoff') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop