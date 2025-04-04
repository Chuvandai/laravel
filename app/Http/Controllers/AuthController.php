<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials= $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)){
            $user= Auth::user();
            if($user->role ==='admin'){
                return redirect()->route('admin.home')->with('error','Đăng nhập thành công');
            }else{
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }
        }
    }
    public function showRegisterForm()
    {
        return view('clients.register'); // Trỏ đến file blade: resources/views/clients/register.blade.php
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        // Tạo user mới (giả sử bạn dùng model User)
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}
