<?php

namespace App\Http\Controllers;

use App\Models\Saleoffs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleoffController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Saleoffs::where('Type', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $data = Saleoffs::paginate(10);
        }
        return view('admin.Saleoff.Index', [
            'title' => 'Quản lý khuyến mãi'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
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
