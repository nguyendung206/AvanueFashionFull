<?php

namespace App\Http\Controllers;

use App\Models\Shippers;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Shippers::where('ShipperName', 'like', '%' . $request->search . '%')->get()->paginate(15);
        } else {
            $data = Shippers::paginate(15);
        }
        return view('admin.Shipper.Index', [
            'title' => 'Quản lý người giao hàng'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function Create()
    {
        $shipper = new Shippers();
        $shipper->ShipperId = 0;
        return view('admin.Shipper.Edit', [
            'title' => 'Thêm người giao hàng'
        ], compact('shipper'));
    }
    public function Edit($ShipperId)
    {
        $shipper = Shippers::where('ShipperId', $ShipperId)->first();
        return view('admin.Shipper.Edit', [
            'title' => 'Cập nhật thông tin người giao hàng',
        ], compact('shipper'));
    }
    public function Save(Request $request)
    {
        if ($request->ShipperId == 0) {
            $shipper = new Shippers();
            $shipper->ShipperName = $request->ShipperName;
            $shipper->Phone = $request->Phone;
            $shipper->save();
            return redirect()->route('shipper')->with('message', 'Thêm người giao hàng thành công');
        } else {
            $shipper = Shippers::where('ShipperId', $request->ShipperId)->first();
            if ($shipper) {
                $shipper->ShipperName = $request->ShipperName;
                $shipper->Phone = $request->Phone;
                $shipper->save();
                return redirect()->route('shipper')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($ShipperId)
    {
        $shipper = Shippers::where('ShipperId', $ShipperId)->first();
        return view('admin.Shipper.Delete', [
            'title' => 'Xóa người giao hàng',
        ], compact('shipper'));
    }
    public function delete(Request $request, $ShipperId)
    {
        $shipper = Shippers::find($ShipperId);

        if (!$shipper) {
            return redirect()->back()->with('error', 'Không tìm thấy người giao hàng để xóa');
        }

        $shipper->delete();
        return redirect()->route('shipper')->with('message', 'Xóa người giao hàng thành công');
    }
}
