<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Jika admin sudah login, langsung arahkan ke dashboard saja biar praktis
        if (session('is_admin') === true) {
            return redirect()->route('admin.dashboard');
        }
        return view('landing');
    }
}