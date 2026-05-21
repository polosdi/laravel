<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::where('id_users', Auth::id())
            ->orderByDesc('waktu')
            ->paginate(20);

        return view('siswa.log.index', compact('logs'));
    }
}
