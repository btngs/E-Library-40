<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $bukuPopuler = Buku::query()
            ->with('kategori')
            ->withCount('peminjaman')
            ->orderByDesc('peminjaman_count')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $bukuTerbaru = Buku::query()
            ->with('kategori')
            ->latest()
            ->limit(8)
            ->get();

        $totalDenda = Peminjaman::query()
            ->where('user_id', $user->id)
            ->where('status', Peminjaman::STATUS_DIPINJAM)
            ->get()
            ->sum('estimated_denda');

        return view('anggota.dashboard', [
            'bukuPopuler' => $bukuPopuler,
            'bukuTerbaru' => $bukuTerbaru,
            'totalKategori' => Kategori::query()->count(),
            'totalBuku' => Buku::query()->count(),
            'totalUser' => User::query()
                ->where('role', 'siswa')
                ->count(),
            'totalDenda' => $totalDenda,
        ]);
    }
}
