<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function create(): View
    {
        $siswa = User::where('role', 'siswa')
            ->where('registration_status', User::REGISTRATION_APPROVED)
            ->orderBy('name')
            ->get();

        $buku = Buku::where('stok', '>', 0)
            ->orderBy('judul')
            ->get();

        return view('peminjaman.create', compact('siswa', 'buku'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
            'jatuh_tempo' => 'required|date|after:today',
        ]);

        $buku = Buku::find($request->buku_id);

        if ($buku->stok < 1) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Stok buku habis.',
            ])->withInput();
        }

        DB::transaction(function () use ($request, $buku) {
            $buku->decrement('stok');

            Peminjaman::create([
                'user_id' => $request->user_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => now(),
                'jatuh_tempo' => $request->jatuh_tempo,
                'status' => Peminjaman::STATUS_DIPINJAM,
            ]);
        });

        return to_route('admin.peminjaman.index', ['tab' => 'pinjam'])->with('status', [
            'type' => 'success',
            'message' => 'Peminjaman berhasil didaftarkan.',
        ]);
    }

    public function index(Request $request): View
    {
        $requestTab = $request->query('tab', 'request');

        $requestPinjam = Peminjaman::query()
            ->with(['user', 'buku.kategori'])
            ->where('status', Peminjaman::STATUS_MENUNGGU)
            ->latest()
            ->get();

        $sedangDipinjam = Peminjaman::query()
            ->with(['user', 'buku.kategori'])
            ->where('status', Peminjaman::STATUS_DIPINJAM)
            ->latest()
            ->get();

        $pendingKembali = Peminjaman::query()
            ->with(['user', 'buku.kategori'])
            ->where('status', Peminjaman::STATUS_PENDING_KEMBALI)
            ->latest()
            ->get();

        return view('peminjaman.index', [
            'requestPinjam' => $requestPinjam,
            'sedangDipinjam' => $sedangDipinjam,
            'pendingKembali' => $pendingKembali,
            'activeTab' => $requestTab === 'pinjam' ? 'pinjam' : ($requestTab === 'pending' ? 'pending' : 'request'),
            'totalRequest' => $requestPinjam->count(),
            'totalDipinjam' => $sedangDipinjam->count(),
            'totalPendingKembali' => $pendingKembali->count(),
            'totalTerlambat' => $sedangDipinjam->filter(function ($item) {
                return $item->jatuh_tempo?->isPast();
            })->count(),
        ]);
    }

    public function approve(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Request ini sudah diproses sebelumnya.',
            ]);
        }

        $buku = Buku::query()->find($peminjaman->buku_id);

        if (! $buku || $buku->stok < 1) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Request tidak bisa diterima karena stok buku habis.',
            ]);
        }

        DB::transaction(function () use ($peminjaman, $buku) {
            $buku->decrement('stok');

            $peminjaman->update([
                'status' => Peminjaman::STATUS_DIPINJAM,
                'tanggal_pinjam' => now()->toDateString(),
                'jatuh_tempo' => now()->addDays(7)->toDateString(),
                'tanggal_kembali' => null,
            ]);
        });

        return to_route('admin.peminjaman.index', ['tab' => 'request'])->with('status', [
            'type' => 'success',
            'message' => 'Request peminjaman berhasil diterima.',
        ]);
    }

    public function reject(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Request ini sudah diproses sebelumnya.',
            ]);
        }

        $peminjaman->delete();

        return to_route('admin.peminjaman.index', ['tab' => 'request'])->with('status', [
            'type' => 'success',
            'message' => 'Request peminjaman berhasil ditolak.',
        ]);
    }

    public function confirmReturn(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_PENDING_KEMBALI) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Pengembalian ini belum dalam status pending.',
            ]);
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->buku?->increment('stok');

            $peminjaman->update([
                'status' => Peminjaman::STATUS_DIKEMBALIKAN,
                'tanggal_kembali' => now(),
            ]);
        });

        return to_route('admin.peminjaman.index', ['tab' => 'pending'])->with('status', [
            'type' => 'success',
            'message' => 'Pengembalian berhasil dikonfirmasi.',
        ]);
    }

    public function rejectReturn(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_PENDING_KEMBALI) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Pengembalian ini belum dalam status pending.',
            ]);
        }

        $peminjaman->update([
            'status' => Peminjaman::STATUS_DIPINJAM,
        ]);

        return to_route('peminjaman.index', ['tab' => 'pending'])->with('status', [
            'type' => 'success',
            'message' => 'Pengembalian dibatalkan dan status dikembalikan ke dipinjam.',
        ]);
    }
}
