<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DendaController extends Controller
{
    public function index(): View
    {
        $dendaList = Peminjaman::query()
            ->with(['user', 'buku'])
            ->where('denda_lunas', false)
            ->where(function ($q) {
                $q->where('denda', '>', 0)
                  ->orWhere(function ($q2) {
                      $q2->whereIn('status', [Peminjaman::STATUS_DIPINJAM, Peminjaman::STATUS_DIKEMBALIKAN, Peminjaman::STATUS_PENDING_KEMBALI])
                         ->where('jatuh_tempo', '<', now()->startOfDay());
                  });
            })
            ->latest()
            ->get();

        $totalDenda = $dendaList->sum('estimated_denda');
        $totalSiswa = $dendaList->unique('user_id')->count();

        return view('denda.index', compact('dendaList', 'totalDenda', 'totalSiswa'));
    }

    public function selesaikan(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->denda_lunas) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Denda sudah dinyatakan lunas sebelumnya.',
            ]);
        }

        // Kunci nilai denda jika masih 0 (baru dihitung dari accessor estimated_denda)
        $dendaDibayar = $peminjaman->estimated_denda;
        
        $peminjaman->update([
            'denda' => $dendaDibayar,
            'denda_lunas' => true,
        ]);

        return back()->with('status', [
            'type' => 'success',
            'message' => 'Denda berhasil diselesaikan.',
        ]);
    }
}
