<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Stores::where('StoreName', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $data = Stores::paginate(10);
        }
        return view('admin.Store.Index', [
            'title' => 'Quản lý chi nhánh cửa hàng'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function Create()
    {
        $store = new Stores();
        $store->StoreId = 0;
        return view('admin.Store.Edit', [
            'title' => 'Thêm cửa hàng'
        ], compact('store'));
    }
    public function Edit($StoreId)
    {
        $store = Stores::where('StoreId', $StoreId)->first();
        return view('admin.Store.Edit', [
            'title' => 'Cập nhật thông tin cửa hàng',
        ], compact('store'));
    }
    public function Save(Request $request)
    {
        if ($request->StoreId == 0) {
            $store = new Stores();
            $store->StoreName = $request->StoreName;
            $store->Email = $request->Email;
            $store->Phone = $request->Phone;
            $store->Address = $request->Address;
            $store->Website = $request->Website;
            $store->TimeOnline = $request->TimeOnline;
            $store->Information = $request->Information;
            $store->save();
            return redirect()->route('store')->with('message', 'Thêm cửa hàng thành công');
        } else {
            $store = Stores::where('StoreId', $request->StoreId)->first();
            if ($store) {
                $store->StoreName = $request->StoreName;
                $store->Email = $request->Email;
                $store->Phone = $request->Phone;
                $store->Address = $request->Address;
                $store->Website = $request->Website;
                $store->TimeOnline = $request->TimeOnline;
                $store->Information = $request->Information;
                $store->save();
                return redirect()->route('store')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($StoreId)
    {
        $store = Stores::where('StoreId', $StoreId)->first();
        return view('admin.Store.Delete', [
            'title' => 'Xóa cửa hàng',
        ], compact('store'));
    }
    public function delete(Request $request, $StoreId)
    {
        $store = Stores::find($StoreId);

        if (!$store) {
            return redirect()->back()->with('error', 'Không tìm thấy cửa hàng để xóa');
        }

        $store->delete();
        return redirect()->route('store')->with('message', 'Xóa cửa hàng thành công');
    }
}
