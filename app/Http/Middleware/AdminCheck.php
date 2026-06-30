<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah di session browser ada tanda 'is_admin' yang bernilai true
        if (!session()->has('is_admin') || session('is_admin') !== true) {
            return redirect()->route('admin.login')->with('error', 'Waduh, login dulu bro!');
        }

        return $next($request);
    }
}