<?php

namespace App\Http\Controllers;

use App\Models\Saleoffs;
use Illuminate\Http\Request;

class SaleoffController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Saleoffs::where('Type', 'like', '%' . $request->search . '%')->get();
        } else {
            $data = Saleoffs::all();
        }
        return view('admin.Saleoff.Index', [
            'title' => 'Quản lý khuyến mãi'
        ], compact('data'));
    }

    public function Create()
    {
        $saleoff = new Saleoffs();
        $saleoff->SaleOffId = 0;
        return view('admin.Saleoff.Edit', [
            'title' => 'Thêm khuyến mãi'
        ], compact('saleoff'));
    }
    public function Edit($SaleOffId)
    {
        $saleoff = Saleoffs::where('SaleOffId', $SaleOffId)->first();
        return view('admin.Saleoff.Edit', [
            'title' => 'Cập nhật thông tin khuyến mãi',
        ], compact('saleoff'));
    }
    public function Save(Request $request)
    {
        if ($request->SaleOffId == 0) {
            $saleoff = new Saleoffs();
            $saleoff->Type = $request->Type;
            $saleoff->DiscountPrice = $request->DiscountPrice;
            $saleoff->save();
            return redirect('saleoff')->with('message', 'Thêm khuyến mãi thành công');
        } else {
            $saleoff = Saleoffs::where('SaleOffId', $request->SaleOffId)->first();
            if ($saleoff) {
                $saleoff->Type = $request->Type;
                $saleoff->DiscountPrice = $request->DiscountPrice;
                $saleoff->save();
                return redirect('saleoff')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($SaleOffId)
    {
        $saleoff = Saleoffs::where('SaleOffId', $SaleOffId)->first();
        return view('admin.Saleoff.Delete', [
            'title' => 'Xóa khuyến mãi',
        ], compact('saleoff'));
    }
    public function delete(Request $request, $SaleOffId)
    {
        $saleoff = Saleoffs::find($SaleOffId);

        if (!$saleoff) {
            return redirect()->back()->with('error', 'Không tìm thấy Size để xóa');
        }

        $saleoff->delete();
        return redirect('saleoff')->with('message', 'Xóa Size thành công');
    }
}
