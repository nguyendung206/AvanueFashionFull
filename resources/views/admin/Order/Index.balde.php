@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <!--Form đầu vào tìm kiếm-->
        <form id="formSearch" action="~/Order/Search" method="get" data-container="#searchResult">
            <div class="row">
                <div class="col-sm-2">
                    <select class="form-control" name="@nameof(Model.Status)">
                        <option value="0">-- Trạng thái --</option>
                        <option value="1">Đơn hàng mới (chờ duyệt)</option>
                        <option value="2">Đơn hàng đã duyệt (chờ chuyển hàng)</option>
                        <option value="3">Đơn hàng đang được giao</option>
                        <option value="4">Đơn hàng đã hoàn tất thành công</option>
                        <option value="-1">Đơn hàng bị hủy</option>
                        <option value="-2">Đơn hàng bị từ chối</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="@nameof(Model.DateRange)" class="form-control daterange-picker" placeholder="" value="@Model.DateRange" />
                </div>
                <div class="col-sm-8 input-group">
                    <input type="hidden" name="@nameof(Model.PageSize)" value="@Model.PageSize" />
                    <input name="@nameof(Model.SearchValue)" type="text" class="form-control" placeholder="Tìm kiếm theo tên khách hàng hoặc tên người giao hàng" value="@Model.SearchValue">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat btn-info">
                            <i class="fa fa-search"></i> Tìm kiếm
                        </button>
                    </span>
                </div>
            </div>
        </form>
        <!-- Kết quả tìm kiếm -->
        <div id="searchResult">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="bg-primary">
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Nhân viên phụ trách</th>
                            <th>Thời điểm duyệt</th>
                            <th>Người giao hàng</th>
                            <th>Ngày nhận giao hàng</th>
                            <th>Thời điểm kết thúc</th>
                            <th>Trạng thái</th>
                            <th style="width:40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (var item in Model.Data)
                        {
                        <tr>
                            <td>@item.CustomerName</td>
                            <td>@item.OrderTime</td>
                            <td>@item.EmployeeName</td>
                            <td>@item.AcceptTime</td>
                            <td>@item.ShipperName</td>
                            <td>@item.ShippedTime</td>
                            <td>@item.FinishedTime</td>
                            <td>@item.StatusDescription</td>
                            <td>
                                <a href="~/Order/Details/@item.OrderId" class="btn btn-info btn-xs">
                                    <i class="glyphicon glyphicon-th-list"></i>
                                </a>
                            </td>
                        </tr>
                        }
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                {{$data->links()}}
            </div>
        </div>

    </div>
</div>
@stop();