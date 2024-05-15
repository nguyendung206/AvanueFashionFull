@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form class="form-horizontal" action="{{ route('savesaleoffproduct') }}" method="post">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $ProductId }}" />
            @foreach($saleoffs as $saleoff)
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input control-label col-sm-1" id="saleoff_{{ $saleoff->SaleOffId }}" name="SaleOffId[]" value="{{ $saleoff->SaleOffId }}">
                <label class="form-check-label col-sm-10" for="saleoff_{{ $saleoff->SaleOffId }}">{{ $saleoff->Type.' '.$saleoff->DiscountPrice }}</label>
            </div>
            @endforeach
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Lưu dữ liệu
                    </button>
                    <a class="btn btn-default" href="{{ route('editproduct', $ProductId) }}">
                        Quay lại
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
