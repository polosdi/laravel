<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanPkl;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = LaporanPkl::olehSiswa(Auth::id())
            ->latest('created_at')
            ->paginate(10);

        $total      = LaporanPkl::olehSiswa(Auth::id())->count();
        $disetujui  = LaporanPkl::olehSiswa(Auth::id())->disetujui()->count();
        $pending    = LaporanPkl::olehSiswa(Auth::id())->where('status_pembimbing', 'pending')->count();
        $revisi     = LaporanPkl::olehSiswa(Auth::id())->where('status_pembimbing', 'revisi')->count();

        return view('siswa.laporan.index', compact(
            'laporans', 'total', 'disetujui', 'pending', 'revisi'
        ));
    }

    public function create()
    {
        return view('siswa.laporan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_laporan' => ['nullable', 'string', 'max:200'],
            'jenis_laporan' => ['required', 'in:mingguan,akhir'],
            'file_laporan'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        $filePath = null;
        if ($request->hasFile('file_laporan')) {
            $filePath = $request->file('file_laporan')
                ->store('laporan/' . Auth::id(), 'public');
        }

        $laporan = LaporanPkl::create([
            'siswa_id'       => Auth::id(),
            'judul_laporan'  => $validated['judul_laporan'],
            'jenis_laporan'  => $validated['jenis_laporan'],
            'file_path'      => $filePath,
            'status_pembimbing' => 'pending',
            'status_wakasek'    => 'pending',
        ]);

        LogAktivitas::catat("Mengunggah laporan PKL: {$laporan->judul()}");

        return redirect()->route('siswa.laporan')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function show(int $id)
    {
        $laporan = LaporanPkl::olehSiswa(Auth::id())->findOrFail($id);
        return view('siswa.laporan.show', compact('laporan'));
    }

    /* Upload file ke laporan yang sudah ada */
    public function upload(Request $request, int $id)
    {
        $laporan = LaporanPkl::olehSiswa(Auth::id())->findOrFail($id);

        $request->validate([
            'file_laporan' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        // Hapus file lama
        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->file_path = $request->file('file_laporan')
            ->store('laporan/' . Auth::id(), 'public');
        $laporan->status_pembimbing = 'pending'; // reset setelah upload ulang
        $laporan->save();

        LogAktivitas::catat("Mengunggah ulang file laporan ID #{$id}");

        return back()->with('success', 'File laporan berhasil diupload.');
    }
}
