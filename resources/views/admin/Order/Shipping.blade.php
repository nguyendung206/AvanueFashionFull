<div class="modal-dialog">
    <div class="modal-content">
        <form id="formShipping" action="{{ route('shipped') }}" method="post">
            @csrf
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chuyển giao hàng cho đơn hàng</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Người giao hàng:</label>
                    <select class="form-control" name="shipperID">
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