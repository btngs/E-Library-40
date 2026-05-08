<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'totalBuku' => Buku::query()->count(),
            'totalKategori' => Kategori::query()->count(),
            'totalUser' => User::query()
                ->where('role', 'siswa')
                ->where('registration_status', 'approved')
                ->count(),
            'totalStok' => Buku::query()->sum('stok'),
            'bukuPopuler' => Buku::query()
                ->withCount(['peminjaman'])
                ->orderByDesc('peminjaman_count')
                ->limit(5)
                ->get(),
            'peminjamanHistori' => Peminjaman::query()
                ->whereIn('status', [Peminjaman::STATUS_DIKEMBALIKAN, Peminjaman::STATUS_DIPINJAM])
                ->with(['buku', 'user'])
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
