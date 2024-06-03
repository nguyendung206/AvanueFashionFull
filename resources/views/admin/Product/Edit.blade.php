@extends('admin.layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form action="{{route('saveproduct')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ProductId" value="{{$product->ProductId}}" />
            <div class="form-group">
                <label>Tên mặt hàng:</label>
                <input type="text" class="form-control" name="ProductName" value="{{$product->ProductName}}">
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <input type="text" class="form-control" name="Price" value="{{$product->Price}}">
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <input type="text" class="form-control" name="ProductDescription" value="{{$product->ProductDescription}}">
            </div>
            <div class="form-group">
                <label>Loại hàng:</label>
                <select class="form-control" name="CategoryId">
                    <option value="0">-- Chọn loại hàng --</option>
                    @foreach($categories as $item)
                    <option value="{{ $item->CategoryId }}" {{ $item->CategoryId == $product->CategoryId ? 'selected' : '' }}>
                        {{ $item->CategoryName }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ảnh minh họa:</label>
                <input type="hidden" name="ProductPhoto" value="{{$product->ProductPhoto}}" />
                <input type="file" class="form-control" name="uploadPhoto" onchange="document.getElementById('Photo').src = window.URL.createObjectURL(this.files[0])" />
            </div>
            <div class="form-group">
                <div>
                    <img id="Photo" src="/upload/product/{{$product->ProductPhoto}}" class="img img-bordered" style="width:200px" />
                </div>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i>
                    Lưu dữ liệu
                </button>
                <a href="{{route('product')}}" class="btn btn-default">Quay lại</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@if($isEdit)

<div class="box box-info">
    <div class="box-header with-border ">
        <h3 class="box-title">Ảnh của mặt hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="bg-gray">
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('addphotoproduct', ['ProductId' => $product->ProductId, 'PhotoId' => 0,'method' => 'add']) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                <tr>
                    <td style="vertical-align:middle">
                        <img src="/upload/product/{{ $photo->Photo }}" style="width:100px" />
                    </td>
                    <td style="vertical-align:middle;">{{ $photo->Description }}</td>
                    <td style="vertical-align:middle; text-align:right">
                        <a class="btn btn-danger btn-sm" href="{{ route('deletephotoproduct', ['ProductId' => $product->ProductId, 'PhotoId' => $photo->PhotoId, 'method' => 'delete']) }}" onclick="return confirm('Xóa ảnh này của mặt hàng?')">
                            <i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">
    </div>
</div>

<div class="box box-info">

    <div class="box-header with-border ">
        <h3 class="box-title">Màu của mặt hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="bg-gray">
                    <th>Tên màu</th>
                    <th>Màu minh họa</th>
                    <th class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('addcolorproduct', ['ProductId' => $product->ProductId, 'ColorId' => 0,'method' => 'add']) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                <tr>
                    <td style="vertical-align:middle">{{ $color->ColorName }}</td>
                    <td style="vertical-align:middle; background-color: <?php echo $color->ColorIllustration; ?>;"></td>
                    <td style="vertical-align:middle; text-align:right">
                        <a class="btn btn-danger btn-sm" href="{{ route('deletecolorproduct', ['ProductId' => $product->ProductId, 'ColorId' => $color->ColorId, 'method' => 'delete']) }}" onclick="return confirm('Xóa màu này của mặt hàng?')">
                            <i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">
    </div>

</div>

<div class="box box-info">
    <div class="box-header with-border ">
        <h3 class="box-title">Size của mặt hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="bg-gray">
                    <th>Tên size</th>
                    <th>Mô tả</th>
                    <th class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('addsizeproduct', ['ProductId' => $product->ProductId, 'SizeId' => 0,'method' => 'add']) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)
                <tr>
                    <td style="vertical-align:middle">{{ $size->SizeName }}</td>
                    <td style="vertical-align:middle;">{{ $size->SizeDescription }}</td>
                    <td style="vertical-align:middle; text-align:right">
                        <a class="btn btn-danger btn-sm" href="{{ route('deletesizeproduct', ['ProductId' => $product->ProductId, 'SizeId' => $size->SizeId, 'method' => 'delete']) }}" onclick="return confirm('Xóa size này của mặt hàng?')">
                            <i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">
    </div>

</div>

<div class="box box-info">
    <div class="box-header with-border ">
        <h3 class="box-title">Khuyến mãi của mặt hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="bg-gray">
                    <th>Tên khuyến mãi</th>
                    <th>Giá trị</th>
                    <th class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('addsaleoffproduct', ['ProductId' => $product->ProductId, 'SaleOffId' => 0,'method' => 'add']) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($saleoffs as $saleoff)
                <tr>
                    <td style="vertical-align:middle">{{ $saleoff->Type }}</td>
                    <td style="vertical-align:middle;">{{ $saleoff->DiscountPrice }}</td>
                    <td style="vertical-align:middle; text-align:right">
                        <a class="btn btn-danger btn-sm" href="{{ route('deletesaleoffproduct', ['ProductId' => $product->ProductId, 'SaleOffId' => $saleoff->SaleOffId, 'method' => 'delete']) }}" onclick="return confirm('Xóa khuyến mãi này của mặt hàng?')">
                            <i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">
    </div>

</div>

<div class="box box-info">
    <div class="box-header with-border ">
        <h3 class="box-title">Tag của mặt hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="bg-gray">
                    <th>Tên tag</th>
                    <th>Mô tả</th>
                    <th class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('addtagproduct', ['ProductId' => $product->ProductId, 'TagId' => 0,'method' => 'add']) }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td style="vertical-align:middle">{{ $tag->TagName }}</td>
                    <td style="vertical-align:middle;">{{ $tag->TagDescription }}</td>
                    <td style="vertical-align:middle; text-align:right">
                        <a class="btn btn-danger btn-sm" href="{{ route('deletetagproduct', ['ProductId' => $product->ProductId, 'TagId' => $tag->TagId, 'method' => 'delete']) }}" onclick="return confirm('Xóa tag này của mặt hàng?')">
                            <i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer text-center">
    </div>

</div>
@endif
@stop();