@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{ route('savesaleoff') }}" method="post">
            @csrf
            <input type="hidden" name="SaleOffId" value="{{ $saleoff->SaleOffId }}" />
            <div class="form-group">
                <label>Loại khuyến mãi:</label>
                <br>
                <label>
                    <input type="radio" class="form-check-input" name="Type" value="Voucher" {{ $saleoff->Type == 'Voucher' ? 'checked' : '' }}>
                    Voucher
                </label>
                <label>
                    <input type="radio" class="form-check-input" name="Type" value="Discount" {{ $saleoff->Type == 'Discount' ? 'checked' : '' }}>
                    Discount
                </label>
            </div>
            <div class="form-group">
                <label>Giá trị:</label>
                <input type="text" class="form-control" name="DiscountPrice" value="{{ $saleoff->DiscountPrice }}">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{ route('saleoff') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@stop
