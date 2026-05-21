<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\NilaiPkl;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = NilaiPkl::where('siswa_id', Auth::id())
            ->with('pembimbing')
            ->latest('created_at')
            ->first();

        return view('siswa.nilai.index', compact('nilai'));
    }
}
