<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    //
    // แสดงแบบฟอร์มลงทะเบียน
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // การลงทะเบียนผู้ใช้ใหม่
    public function register(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'salutation' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'house_number' => 'required|string',
            'village' => 'required|string',
            'subdistrict' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
        ]);

        // สร้างข้อมูลในตาราง users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'user',
        ]);

        // สร้างข้อมูลในตาราง user_details
        UserDetail::create([
            'user_id' => $user->id,
            'salutation' => $request->salutation,
            'age' => $request->age,
            'phone' => $request->phone,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
        ]);

        return redirect()->route('showLoginForm')->with('success', 'ลงทะเบียนเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ');
    }

    // แสดงแบบฟอร์มเข้าสู่ระบบ
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // เข้าสู่ระบบ
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // ตรวจสอบ level ของผู้ใช้
            if (Auth::user()->level === 'admin') {
                return redirect()->route('adminshowform'); // สำหรับ admin เปลี่ยนเส้นทางไปยังหน้า dashboard
            } elseif (Auth::user()->level === 'user') {
                return redirect()->route('userAccountFormsIndex'); // สำหรับ user เปลี่ยนเส้นทางไปยังหน้า users_form
            }
        }


        return back()->withErrors([
            'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
        ]);
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('userFormsIndex');
    }
}
