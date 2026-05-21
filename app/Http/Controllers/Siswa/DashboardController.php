<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JurnalHarian;
use App\Models\LaporanPkl;
use App\Models\NilaiPkl;
use App\Models\PklAnggota;
use App\Models\PklPengajuan;
use App\Models\ProfilSiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // ── 1. Profil Siswa ─────────────────────────────────────────
        $siswa = ProfilSiswa::where('user_id', $user->id)->first();

        // ── 2. PKL Aktif ─────────────────────────────────────────────
        // Cari keanggotaan PKL yang masih aktif
        $anggota = PklAnggota::where('siswa_id', $user->id)
            ->where('status_keanggotaan', 'aktif')
            ->with('pengajuan')
            ->first();

        $pkl         = $anggota?->pengajuan;
        $pembimbing  = null;
        $sisiHari    = null;
        $persen      = 0;

        if ($pkl) {
            // Hanya tampilkan sebagai "aktif" jika sudah disetujui wakasek
            if ($pkl->status_wakasek !== 'disetujui') {
                $pkl = null; // belum aktif penuh
            } else {
                $pembimbing = $pkl->pembimbing_id
                    ? User::find($pkl->pembimbing_id)
                    : null;

                $sisiHari = $pkl->sisiHari();
                $persen   = $pkl->persenKemajuan();
            }
        }

        // Kalau tidak ada yang aktif, cek apakah ada pengajuan pending
        // (untuk ditampilkan di card "Informasi PKL")
        if (!$pkl) {
            $pkl = PklPengajuan::where('ketua_id', $user->id)
                ->orWhereHas('anggota', fn($q) => $q->where('siswa_id', $user->id))
                ->latest('tanggal_pengajuan')
                ->first();

            if ($pkl) {
                $pembimbing = $pkl->pembimbing_id ? User::find($pkl->pembimbing_id) : null;
            }
        }

        // ── 3. Jurnal Harian ─────────────────────────────────────────
        $jurnals       = JurnalHarian::olehSiswa($user->id)
            ->orderByDesc('tanggal')
            ->take(5)
            ->get();

        $totalJurnal   = JurnalHarian::olehSiswa($user->id)->count();
        $jurnalValid   = JurnalHarian::olehSiswa($user->id)->valid()->count();
        $jurnalPending = JurnalHarian::olehSiswa($user->id)->pending()->count();

        // ── 4. Absensi ───────────────────────────────────────────────
        $absensi    = Absensi::olehSiswa($user->id)
            ->orderByDesc('tanggal')
            ->take(5)
            ->get();

        $hadir      = Absensi::olehSiswa($user->id)->hadir()->count();
        $totalAbsen = Absensi::olehSiswa($user->id)->count();
        $skorAbsen  = $totalAbsen > 0
            ? round($hadir / $totalAbsen * 100)
            : 0;

        // ── 5. Laporan PKL ───────────────────────────────────────────
        $laporans         = LaporanPkl::olehSiswa($user->id)
            ->latest('created_at')
            ->take(4)
            ->get();

        $laporanCount     = LaporanPkl::olehSiswa($user->id)->count();
        $laporanDisetujui = LaporanPkl::olehSiswa($user->id)->disetujui()->count();

        // ── 6. Nilai PKL ─────────────────────────────────────────────
        $nilai      = NilaiPkl::where('siswa_id', $user->id)
            ->latest('created_at')
            ->first();

        $nilaiAkhir = $nilai?->nilai_akhir;
        $predikat   = $nilai?->predikat;

        // ── Kirim ke view ────────────────────────────────────────────
        return view('siswa.dashboard', compact(
            'user',
            'siswa',
            'pkl',
            'pembimbing',
            'sisiHari',
            'persen',
            'jurnals',
            'totalJurnal',
            'jurnalValid',
            'jurnalPending',
            'absensi',
            'hadir',
            'skorAbsen',
            'laporans',
            'laporanCount',
            'laporanDisetujui',
            'nilai',
            'nilaiAkhir',
            'predikat',
        ));
    }
}
