<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // Kalau sudah login admin, langsung lempar ke dashboard
        if (session('is_admin') === true) {
            return redirect()->route('admin.dashboard');
        }
        return view('login-admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Cek password paten pilihanmu
        if ($request->password === 'bakriganteng123') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Kembali Admin!');
        }

        // Jika salah, balikkan ke login dengan pesan error
        return back()->with('error', 'Password salah bro! Coba diingat-ingat lagi.');
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('landing')->with('success', 'Berhasil logout');
    }
}