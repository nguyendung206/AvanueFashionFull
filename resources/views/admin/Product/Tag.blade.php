@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form class="form-horizontal" action="{{ route('savetagproduct') }}" method="post">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $ProductId }}" />
            @foreach($tags as $tag)
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input control-label col-sm-1" id="tag_{{ $tag->TagId }}" name="TagId[]" value="{{ $tag->TagId }}">
                <label class="form-check-label col-sm-10" for="tag_{{ $tag->TagId }}">{{ $tag->TagName }}</label>
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
