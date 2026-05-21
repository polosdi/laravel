<?php
namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;

class WakasekLogController extends Controller
{
    public function index()
    {
        $daftarLog = LogAktivitas::with('user')
            ->orderByDesc('waktu')
            ->get();

        return view('wakasek.log', compact('daftarLog'));
    }
}