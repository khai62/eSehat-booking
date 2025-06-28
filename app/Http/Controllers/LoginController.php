<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'dokter') {
                return redirect()->route('dashboard.dokter');
            } elseif ($user->role === 'pasien') {
                return redirect()->route('dashboard.pasien');
            }  if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');   
            }else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
