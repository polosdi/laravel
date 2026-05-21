<?php

namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;

use App\Models\MitraIndustri;

class WakasekMitraController extends Controller
{
    public function index()
    {
        $daftarMitra = MitraIndustri::orderBy('nama_perusahaan')->get();
        return view('wakasek.mitra', compact('daftarMitra'));
    }
}