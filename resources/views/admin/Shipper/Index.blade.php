@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form id="formSearch" action="{{route('searchshipper')}}" method="get" data-container="#searchResult">
            <!-- Form nhập đầu vào tìm kiếm -->
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Nhập tên người giao hàng cần tìm" autofocus>
                <div class="input-group-btn">
                    <button class="btn btn-info" type="submit" style="padding: 9px 12px;">
                        <i class=" glyphicon glyphicon-search"></i>
                    </button>

                    <a href="{{route('addshipper')}}" class="btn btn-primary" style="margin-left: 5px">
                        <i class="fa fa-plus"></i> Bổ sung
                    </a>
                </div>
            </div>
        </form>

        <!-- Hiển thị kết quả tìm kiếm -->
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa-solid fa-xmark"></i>
            </button>
            {{session()-> get('message')}}
        </div>
        @endif
        <div id="searchResult">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="bg-primary">
                        <tr >
                            <th class=" text-center">Tên người giao hàng</th>
                            <th class=" text-center">Số điện thoại</th>
                            <th style="width:100px" class=" text-center">Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->ShipperName }}</td>
                            <td>{{ $item->Phone }}</td>
                            <td class="text-center">
                                <a href="{{ route('editshipper', $item->ShipperId) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('deleteshipper', $item->ShipperId) }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>

<!--  -->
@stop();