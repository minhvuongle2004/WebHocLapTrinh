<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Hiển thị trang đăng nhập
    public function showLoginForm()
    {
        return view('user.themes.login.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            return redirect()->intended('/');
        }

        return back()->withErrors(['username' => 'Tên đăng nhập hoặc mật khẩu không chính xác']);
    }


    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:200',
            'displayname' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:tbl_users,username',
            'email' => 'required|string|email|max:100|unique:tbl_users,email',
            'password' => 'required|string|min:8|max:50|confirmed',
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'displayname' => $request->displayname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60), // Đảm bảo không lỗi token
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('user.login')  // Hoặc route bạn muốn redirect
            ]);
        }

        return redirect()->route('user.login')->with('success', 'Đăng ký thành công!');

    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }
}