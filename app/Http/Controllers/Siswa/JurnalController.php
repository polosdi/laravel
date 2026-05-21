<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JurnalHarian;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    /* ─────────────────────────────────────────
     | Index — daftar jurnal milik siswa
    ───────────────────────────────────────── */
    public function index(Request $request)
    {
        $query = JurnalHarian::olehSiswa(Auth::id())
            ->orderByDesc('tanggal');

        // Filter status validasi
        if ($request->filled('status')) {
            $query->where('status_validasi', $request->status);
        }

        // Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $jurnals = $query->paginate(15)->withQueryString();

        $totalJurnal   = JurnalHarian::olehSiswa(Auth::id())->count();
        $jurnalValid   = JurnalHarian::olehSiswa(Auth::id())->valid()->count();
        $jurnalPending = JurnalHarian::olehSiswa(Auth::id())->pending()->count();

        return view('siswa.jurnal.index', compact(
            'jurnals', 'totalJurnal', 'jurnalValid', 'jurnalPending'
        ));
    }

    /* ─────────────────────────────────────────
     | Create — form tambah jurnal
    ───────────────────────────────────────── */
    public function create()
    {
        // Pastikan belum ada jurnal untuk hari ini
        $sudahAda = JurnalHarian::olehSiswa(Auth::id())
            ->whereDate('tanggal', today())
            ->exists();

        return view('siswa.jurnal.create', compact('sudahAda'));
    }

    /* ─────────────────────────────────────────
     | Store — simpan jurnal baru
    ───────────────────────────────────────── */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'      => ['required', 'date', 'before_or_equal:today'],
            'jam_masuk'    => ['nullable', 'date_format:H:i'],
            'jam_keluar'   => ['nullable', 'date_format:H:i', 'after:jam_masuk'],
            'kegiatan'     => ['required', 'string', 'min:10', 'max:2000'],
            'foto_kegiatan'=> ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Cek duplikat tanggal
        $sudahAda = JurnalHarian::olehSiswa(Auth::id())
            ->whereDate('tanggal', $validated['tanggal'])
            ->exists();

        if ($sudahAda) {
            return back()->withErrors(['tanggal' => 'Jurnal untuk tanggal ini sudah ada.'])->withInput();
        }

        // Upload foto kegiatan
        $fotoPath = null;
        if ($request->hasFile('foto_kegiatan')) {
            $fotoPath = $request->file('foto_kegiatan')
                ->store('jurnal/' . Auth::id(), 'public');
        }

        $jurnal = JurnalHarian::create([
            'siswa_id'        => Auth::id(),
            'tanggal'         => $validated['tanggal'],
            'jam_masuk'       => $validated['jam_masuk']  ?? null,
            'jam_keluar'      => $validated['jam_keluar'] ?? null,
            'kegiatan'        => $validated['kegiatan'],
            'foto_kegiatan'   => $fotoPath,
            'status_validasi' => 'pending',
        ]);

        LogAktivitas::catat("Menambahkan jurnal harian tanggal {$jurnal->tanggal->format('d/m/Y')}");

        return redirect()->route('siswa.jurnal')
            ->with('success', 'Jurnal berhasil ditambahkan, menunggu validasi pembimbing.');
    }

    /* ─────────────────────────────────────────
     | Edit — form edit jurnal (hanya pending)
    ───────────────────────────────────────── */
    public function edit(int $id)
    {
        $jurnal = JurnalHarian::olehSiswa(Auth::id())->findOrFail($id);

        // Hanya boleh edit kalau masih pending
        if ($jurnal->status_validasi !== 'pending') {
            return back()->with('error', 'Jurnal yang sudah divalidasi tidak dapat diedit.');
        }

        return view('siswa.jurnal.edit', compact('jurnal'));
    }

    /* ─────────────────────────────────────────
     | Update — simpan perubahan jurnal
    ───────────────────────────────────────── */
    public function update(Request $request, int $id)
    {
        $jurnal = JurnalHarian::olehSiswa(Auth::id())->findOrFail($id);

        if ($jurnal->status_validasi !== 'pending') {
            return back()->with('error', 'Jurnal yang sudah divalidasi tidak dapat diedit.');
        }

        $validated = $request->validate([
            'tanggal'      => ['required', 'date', 'before_or_equal:today'],
            'jam_masuk'    => ['nullable', 'date_format:H:i'],
            'jam_keluar'   => ['nullable', 'date_format:H:i', 'after:jam_masuk'],
            'kegiatan'     => ['required', 'string', 'min:10', 'max:2000'],
            'foto_kegiatan'=> ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto_kegiatan')) {
            if ($jurnal->foto_kegiatan) {
                Storage::disk('public')->delete($jurnal->foto_kegiatan);
            }
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')
                ->store('jurnal/' . Auth::id(), 'public');
        }

        $jurnal->update($validated);

        LogAktivitas::catat("Mengedit jurnal harian tanggal {$jurnal->tanggal->format('d/m/Y')}");

        return redirect()->route('siswa.jurnal')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    /* ─────────────────────────────────────────
     | Destroy — hapus jurnal (hanya pending)
    ───────────────────────────────────────── */
    public function destroy(int $id)
    {
        $jurnal = JurnalHarian::olehSiswa(Auth::id())->findOrFail($id);

        if ($jurnal->status_validasi !== 'pending') {
            return back()->with('error', 'Jurnal yang sudah divalidasi tidak dapat dihapus.');
        }

        if ($jurnal->foto_kegiatan) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
        }

        $jurnal->delete();

        LogAktivitas::catat("Menghapus jurnal harian tanggal {$jurnal->tanggal->format('d/m/Y')}");

        return back()->with('success', 'Jurnal berhasil dihapus.');
    }
}
