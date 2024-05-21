@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-header text-right">
        <div class="btn-group">
            @if($status != -1 && $status != -2 && $status != 4)
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                Xử lý đơn hàng <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                @if($status == 1)
                <li><a href="{{ route('accept', $order->OrderId) }}" onclick="return confirm('Xác nhận duyệt chấp nhận đơn hàng này?')">Duyệt đơn hàng</a></li>
                <li><a href="{{ route('changeaddress', $order->OrderId) }}" class="btn-modal">Thay đổi địa chỉ</a></li>
                <li><a href="{{ route('reject', $order->OrderId) }}" onclick="return confirm('Xác nhận từ chối đơn hàng này?')">Từ chối đơn hàng</a></li>
                @elseif($status == 2)
                <li><a href="{{ route('changeaddress', $order->OrderId) }}" class="btn-modal">Thay đổi địa chỉ</a></li>
                <li><a href="#" class="btn-modal" data-toggle="modal" data-target="#shippingModal">Chuyển giao hàng</a></li>
                <li><a href="{{ route('reject', $order->OrderId) }}" onclick="return confirm('Xác nhận từ chối đơn hàng này?')">Từ chối đơn hàng</a></li>
                @elseif($status == 3)
                <li><a href="#" class="btn-modal" data-toggle="modal" data-target="#shippingModal">Chuyển giao hàng</a></li>
                <li><a href="{{ route('finish', $order->OrderId) }}" onclick="return confirm('Xác nhận đơn hàng đã hoàn tất thành công?')">Xác nhận hoàn tất đơn hàng</a></li>
                @endif
                <li><a href="{{ route('cancel', $order->OrderId) }}" onclick="return confirm('Xác nhận hủy đơn hàng này?')">Hủy đơn hàng</a></li>
            </ul>
            @endif

            @if($status == -1 || $status == -2 || $status == 1)
            <a href="{{ route('delete', $order->OrderId) }}" class="btn btn-sm btn-danger" onclick="return confirm('Có chắc chắn muốn xóa đơn hàng này không?')"><i class="fa fa-trash"></i> Xóa đơn hàng</a>
            @endif
            <a href="{{ route('order')}}" class="btn btn-sm btn-info">Quay lại</a>
        </div>

    </div>

    <div class="text-center" style="color:#f00">
        {{ session('message') }}
    </div>

    <div class="box-body form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-2">Mã đơn hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->OrderId  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Ngày lập đơn hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->OrderTime  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Nhân viên phụ trách:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->employee->FullName  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Ngày nhận đơn hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->AcceptTime  ?? ''}}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Khách hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->customer->CustomerName  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Email:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->customer->Email  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Địa chỉ:</label>
            <div class="col-sm-10">
                <p class="form-control-static">{{ $order->customer->Address  ?? ''}}</p>
            </div>

        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Địa chỉ giao hàng:</label>
            <div class="col-sm-10">
                <p class="form-control-static">{{ $order->DeliveryAddress  ?? ''}}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Người giao hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->shipper->ShipperName  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Điện thoại:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->shipper->Phone  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Nhận giao hàng lúc:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->ShippedTime  ?? ''}}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Trạng thái đơn hàng:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->status->Description  ?? ''}}</p>
            </div>
            <label class="control-label col-sm-2">Thời điểm hoàn tất:</label>
            <div class="col-sm-4">
                <p class="form-control-static">{{ $order->FinishedTime  ?? ''}}</p>
            </div>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <caption>
                    <h4>Danh sách mặt hàng thuộc đơn hàng</h4>
                </caption>
                <thead>
                    <tr class="bg-primary">
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên hàng</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Thành tiền</th>
                        @if($status == 1 || $status == 2)
                        <th style="width:80px">Thao tác</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $totalAmount = 0; @endphp
                    @foreach($details as $index => $detail)
                    @php
                    $totalPrice = $detail->Quantity * $detail->product->Price;
                    $totalAmount += $totalPrice;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $detail->product->ProductName }}</td>
                        <td class="text-center">{{ $detail->Quantity }}</td>
                        <td class="text-right">{{ number_format($detail->product->Price) }}</td>
                        <td class="text-right">{{ number_format($totalPrice) }}</td>
                        @if($status == 1 || $status == 2)
                        <td class="text-center">
                            <a href="{{ url('order/edit-detail', ['orderId' => $order->OrderId, 'productId' => $detail->product->ProductId]) }}" class="btn btn-xs btn-primary btn-modal" title="Sửa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ url('order/delete-detail', ['orderId' => $order->OrderId, 'productId' => $detail->product->ProductId]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Xóa mặt hàng này khỏi đơn hàng?')" title="Xóa">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Tổng cộng:</th>
                        <th class="text-right">{{ number_format($totalAmount) }}đ</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- Modal Chuyển giao hàng -->
<div id="shippingModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formShipping" action="{{ route('shipping') }}" method="post">
                @csrf
                <input type="hidden" name="OrderId" value="{{$order->OrderId}}" />
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chuyển giao hàng cho đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Người giao hàng:</label>
                        <select class="form-control" name="ShipperId">
                            <option value="0">-- Chọn người giao hàng ---</option>
                            @foreach ($shippers as $shipper)
                            <option value="{{ $shipper->ShipperId }}">{{ $shipper->ShipperName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <span id="message" style="color:#f00"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i> Cập nhật
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Bỏ qua
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-modal').click(function(e) {
            e.preventDefault();
            $('#shippingModal').modal('show');
        });

        $('#formShipping').submit(function(e) {
            e.preventDefault();

            var url = $(this).prop("action");
            var method = $(this).prop("method");
            var postData = $(this).serialize();

            $.ajax({
                url: url,
                type: method,
                data: postData,
                error: function() {
                    alert("Your request is not valid!");
                },
                success: function(data) {
                    if (data !== "") {
                        $("#message").html(data);
                    } else {
                        location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection