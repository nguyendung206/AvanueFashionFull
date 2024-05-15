<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        return view('admin.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Employees::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->Password)) {
                Session::put('admin', $user);
                return view('admin.Index', [
                    'title' => 'Trang Quản Trị Admin'
                ]);
            } else {
                return redirect()->back()->with('error', 'Mật khẩu không đúng.');
            }
        } else {
            return redirect()->back()->with('error', 'Admin không tồn tại.');
        }
    }

    public function SignOut()
    {
        Session::forget('admin');
        return redirect()->route('login'); 
    }
}
