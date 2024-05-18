@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form id="formSearch" action="{{route('searchemployee')}}" method="get" data-container="#searchResult">
            <!-- Form nhập đầu vào tìm kiếm -->
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Nhập tên nhân viên cần tìm" autofocus>
                <div class="input-group-btn">
                    <button class="btn btn-info" type="submit" style="padding: 9px 12px;">
                        <i class=" glyphicon glyphicon-search"></i>
                    </button>

                    <a href="{{route('addemployee')}}" class="btn btn-primary" style="margin-left: 5px">
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
            @foreach($data as $item)
            <div class="col-sm-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$item->FullName}}</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-box-tool" href="{{ route('editemployee', $item->EmployeeId) }}">
                                <i class="fa fa-edit text-primary"></i>
                            </a>
                            <a class="btn btn-box-tool" href="{{ route('deleteemployee', $item->EmployeeId) }}">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="profile-user-img img-responsive img-bordered" src="/upload/employee/{{ $item->Photo }}">
                            </div>
                            <div class="col-sm-8">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <i class="fa fa-phone"></i> {{$item->Phone}}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-envelope"></i> {{$item->Email}}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-map-marker-alt"></i> {{$item->Address}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            @endforeach
            <div class="text-center">
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
<!--  -->
@stop();