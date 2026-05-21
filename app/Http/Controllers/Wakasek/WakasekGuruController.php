<?php

namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;
use App\Models\User;

class WakasekGuruController extends Controller
{
    public function index()
    {
        $daftarGuru = User::where('role', 'guru')
            ->with('profilGuru')
            ->orderBy('nama_depan')
            ->get();

        return view('wakasek.guru', compact('daftarGuru'));
    }
}