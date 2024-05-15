<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Permisions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Employees::where('FullName', 'like', '%' . $request->search . '%')->get();
        } else {
            $data = Employees::all();
        }
        return view('admin.Employee.Index', [
            'title' => 'Quản lý nhân viên'
        ], compact('data'));
    }

    public function Create()
    {
        $employee = new Employees();
        $permisions = Permisions::all();
        $employee->EmployeeId = 0;
        return view('admin.Employee.Edit', [
            'title' => 'Thêm nhân viên'
        ], compact('employee', 'permisions'));
    }
    public function Edit($EmployeeId)
    {
        $employee = Employees::where('EmployeeId', $EmployeeId)->first();
        $permisions = Permisions::all();
        return view('admin.Employee.Edit', [
            'title' => 'Cập nhật thông tin nhân viên',
        ], compact('employee', 'permisions'));
    }
    public function Save(Request $request)
    {
        if ($request->EmployeeId == 0) {
            $employee = new Employees();
            $employee->FullName = $request->FullName;
            $employee->Email = $request->Email;
            $employee->Phone = $request->Phone;
            $employee->Address = $request->Address;
            $employee->PermisionId = $request->PermisionId;
            $employee->Password = Hash::make(1);
            if ($request->hasFile('uploadPhoto')) {
                $file = $request->file('uploadPhoto');
                $ext = $file->getClientOriginalExtension();
                $file_name = time() . '-' . 'employee.' . $ext;
                $file->move(public_path('upload/employee'), $file_name);
                $employee->Photo = $file_name;
            }
            $employee->save();
            return redirect('employee')->with('message', 'Thêm nhân viên thành công');
        } else {
            $employee = Employees::where('EmployeeId', $request->EmployeeId)->first();
            if ($employee) {
                $employee->FullName = $request->FullName;
                $employee->Email = $request->Email;
                $employee->Phone = $request->Phone;
                $employee->Phone = $request->Phone;
                if ($request->hasFile('uploadPhoto')) {
                    $file = $request->file('uploadPhoto');
                    $ext = $file->getClientOriginalExtension();
                    $file_name = time() . '-' . 'employee.' . $ext;
                    $file->move(public_path('upload/employee'), $file_name);
                    $employee->Photo = $file_name;
                }
                $employee->save();
                return redirect('employee')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($EmployeeId)
    {
        $permisions = Permisions::all();
        $employee = Employees::where('EmployeeId', $EmployeeId)->first();
        return view('admin.Employee.Delete', [
            'title' => 'Xóa nhân viên',
        ], compact('employee','permisions'));
    }
    public function delete($EmployeeId)
    {
        $employee = Employees::find($EmployeeId);

        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy nhân viên để xóa');
        }

        $employee->delete();
        return redirect('employee')->with('message', 'Xóa nhân viên thành công');
    }
}
