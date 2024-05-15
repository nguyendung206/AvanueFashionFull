<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Customers::where('Fullname', 'like', '%' . $request->search . '%')->get();
        } else {
            $data = Customers::all();
        }
        return view('admin.Customer.Index', [
            'title' => 'Quản lý khách hàng'
        ], compact('data'));
    }

    public function Create()
    {
        $customer = new Customers();
        $customer->CustomerId = 0;
        return view('admin.Customer.Edit', [
            'title' => 'Thêm khách hàng'
        ], compact('customer'));
    }
    public function Edit($CustomerId)
    {
        $customer = Customers::where('CustomerId', $CustomerId)->first();
        return view('admin.Customer.Edit', [
            'title' => 'Cập nhật thông tin khách hàng',
        ], compact('customer'));
    }
    public function Save(Request $request)
    {
        if ($request->CustomerId == 0) {
            $customer = new Customers();
            $customer->Fullname = $request->Fullname;
            $customer->Email = $request->Email;
            $customer->Phone = $request->Phone;
            $customer->Address = $request->Address;
            $customer->Password = Hash::make($request->Password);
            $customer->save();
            return redirect('customer')->with('message', 'Thêm khách hàng thành công');
        } else {
            $customer = Customers::where('CustomerId', $request->CustomerId)->first();
            if ($customer) {
                $customer->Fullname = $request->Fullname;
                $customer->Email = $request->Email;
                $customer->Phone = $request->Phone;
                $customer->Address = $request->Address;
                if ($request->has('Password')) {
                    $customer->Password = Hash::make($request->Password);
                }
                $customer->save();
                return redirect('customer')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($CustomerId)
    {
        $customer = Customers::where('CustomerId', $CustomerId)->first();
        return view('admin.Customer.Delete', [
            'title' => 'Xóa khách hàng',
        ], compact('customer'));
    }
    public function delete(Request $request, $CustomerId)
    {
        $customer = Customers::find($CustomerId);

        if (!$customer) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng để xóa');
        }

        $customer->delete();
        return redirect('customer')->with('message', 'Xóa khách hàng thành công');
    }
}
