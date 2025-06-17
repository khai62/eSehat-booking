<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasienAuthController extends Controller
{
    public function showRegister() {
        return view('daftar.daftar-pasien');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'birthdate' => 'required|date',
            'city' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        Auth::login($user);
        return redirect()->route('dashboard.pasien');
    }

    public function showLogin() {
        return view('login.login-pasien');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'pasien') {
                return redirect()->route('dashboard.pasien');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Bukan akun pasien']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pasien.login.form');
    }
}
