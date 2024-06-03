<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.login');
        } else {
            $this->validate($request, [
                'email' => 'required|email:filter',
                'password' => 'required'
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            $user = Customers::where('email', $email)->first();

            if ($user) {
                if (Hash::check($password, $user->Password)) {
                    Session::put('user', $user);
                    auth::login($user);
                    return redirect()->route('home');
                } else {
                    return redirect()->back()->with('error', 'Mật khẩu không đúng.');
                }
            } else {
                return redirect()->back()->with('error', 'Admin không tồn tại.');
            }
        }
    }
    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.login');
        }
        $customer = new Customers();
        $customer->CustomerName = $request->CustomerName;
        $customer->Email = $request->Email;
        $customer->Phone = $request->Phone;
        $customer->Address = $request->Address;
        $customer->Password = Hash::make($request->Password);
        $customer->save();
        return redirect()->route('login')->with('message', 'Thêm khách hàng thành công');
    }
    public function SignOut()
    {
        Session::forget('user');
        Session::forget('cart');
        Auth::logout();
        return redirect()->route('home');
    }
}
