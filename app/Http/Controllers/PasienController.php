<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function profil()
    {
        return view('dashboard.pasien-profil', [
            'user' => Auth::user()
        ]);
    }
}
