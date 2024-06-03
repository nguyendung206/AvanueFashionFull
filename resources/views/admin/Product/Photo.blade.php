@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form class="form-horizontal" action="{{ route('savephotoproduct') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                @csrf
                <input type="hidden" name="ProductId" value="{{ $ProductId }}" />
                <label class="control-label col-sm-2">Ảnh minh họa:</label>
                <div class="col-sm-10">
                    <input type="hidden" name="Photo" />
                    <input type="file" class="form-control" name="uploadPhoto" onchange="document.getElementById('Photo').src = window.URL.createObjectURL(this.files[0])" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-sm-10">
                    <img id="Photo" src="/images/products/@Model.Photo" class="img img-bordered" style="width:200px" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Mô tả:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" autofocus name="Description">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Lưu dữ liệu
                    </button>
                    <a class="btn btn-default" href="~/Product/Edit/@Model.ProductId">
                        Quay lại
                    </a>
                </div>
            </div>
        </form>

    </div>
</div>
@stop