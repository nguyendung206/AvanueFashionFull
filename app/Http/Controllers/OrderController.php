<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Shippers;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo truy vấn với mối quan hệ employees
        $query = Orders::with('employee', 'customer','shipper');

        // Lọc theo Status nếu có
        if ($request->has('Status') && $request->Status != 0) {
            $query->where('Status', $request->Status);
        }

        // Lọc theo DateRange nếu có
        if ($request->has('DateRange') && !empty($request->DateRange)) {
            $dates = explode(' - ', $request->DateRange);
            if (count($dates) == 2) {
                $query->whereBetween('OrderTime', [$dates[0], $dates[1]]);
            }
        }

        // Lọc theo từ khóa tìm kiếm nếu có
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('CustomerName', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('employee', function ($query) use ($search) {
                        $query->where('FullName', 'like', '%' . $search . '%');
                    });
            });
        }

        // Phân trang kết quả
        $data = $query->paginate(10);

        return view('admin.Order.Index', [
            'title' => 'Quản lý đơn hàng',
            'data' => $data, // Chuyển 'data' sang view
            'request' => $request // Chuyển request sang view để gán lại giá trị cho input
        ])->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function Detail($OrderId)
    {
        $order = Orders::with('products', 'shipper')->findOrFail($OrderId);
        $details = $order->details;
        $status = $order->Status;
        $shippers = Shippers::all();

        return view('admin.Order.Detail', [
            'shippers' => $shippers,
            'status' => $status,
            'order' => $order,
            'details' => $details,
            'title' => 'Quản lý đơn hàng'
        ]);
    }

    public function Accept($OrderId)
    {
        $order = Orders::findOrFail($OrderId);
        $employee = session('admin');

        if ($employee) {
            $order->Status = 2;
            $order->AcceptTime = now();
            $order->EmployeeId = $employee->EmployeeId;
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được chấp nhận');
        } else {
            return redirect()->back()->with('error', 'Không thể xác định nhân viên.');
        }
    }

    public function Shipping(Request $request)
    {
        $order = Orders::findOrFail($request->OrderId);
        $employee = session('admin');
        if ($employee) {
            $order->Status = 3;
            $order->ShipperId = $request->ShipperId;
            $order->ShippedTime = now();
            $order->EmployeeId = $employee->EmployeeId;
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được chấp nhận');
        } else {
            return redirect()->back()->with('error', 'Không thể xác định nhân viên.');
        }
    }

    public function Address(Request $request)
    {
        $order = Orders::findOrFail($request->OrderId);
        $order->DeliveryAddress = $request->DeliveryAddress;
        $order->save();
        return redirect()->back();
    }

    public function Reject($OrderId)
    {
        $order = Orders::findOrFail($OrderId);
        $employee = session('admin');

        if ($employee) {
            $order->Status = -2;
            $order->FinishedTime = now();
            $order->EmployeeId = $employee->EmployeeId;
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được từ chối');
        } else {
            return redirect()->back()->with('error', 'Không thể xác định nhân viên.');
        }
    }

    public function Cancel($OrderId)
    {
        $order = Orders::findOrFail($OrderId);
        $employee = session('admin');

        if ($employee) {
            $order->Status = -1;
            $order->FinishedTime = now();
            $order->EmployeeId = $employee->EmployeeId;
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy');
        } else {
            return redirect()->back()->with('error', 'Không thể xác định nhân viên.');
        }
    }

    public function Delete($OrderId)
    {
        $order = Orders::findOrFail($OrderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng để xóa');
        }

        $order->delete();
        $order->products()->detach($OrderId);
        return redirect()->route('order');
    }

    public function Finish($OrderId)
    {
        $order = Orders::findOrFail($OrderId);
        $employee = session('admin');

        if ($employee) {
            $order->Status = 4;
            $order->FinishedTime = now();
            $order->EmployeeId = $employee->EmployeeId;
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy');
        } else {
            return redirect()->back()->with('error', 'Không thể xác định nhân viên.');
        }
    }

    
}
