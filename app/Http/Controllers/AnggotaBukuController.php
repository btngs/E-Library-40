<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaBukuController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $kategoriId = $request->query('kategori');

        $buku = Buku::query()
            ->with('kategori')
            ->withCount('peminjaman')
            ->when($search, function ($query, $search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('judul', 'like', "%{$search}%")
                        ->orWhere('pengarang', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->whereHas('kategori', function ($kategoriQuery) use ($kategoriId) {
                    $kategoriQuery->where('kategori.id', $kategoriId);
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('anggota.peminjaman.index', [
            'buku' => $buku,
            'kategori' => Kategori::query()->orderBy('nama_kategori')->get(),
            'selectedKategori' => $kategoriId,
        ]);
    }

    public function show(Request $request, Buku $buku): View
    {
        $buku->load('kategori');

        $requestAktif = Peminjaman::query()
            ->where('user_id', $request->user()->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', [Peminjaman::STATUS_MENUNGGU, Peminjaman::STATUS_DIPINJAM])
            ->latest()
            ->first();

        $kategoriIds = $buku->kategori->pluck('id');
        $relatedBooks = Buku::query()
            ->with('kategori')
            ->whereKeyNot($buku->id)
            ->when($kategoriIds->isNotEmpty(), function ($query) use ($kategoriIds) {
                $query->whereHas('kategori', function ($kategoriQuery) use ($kategoriIds) {
                    $kategoriQuery->whereIn('kategori.id', $kategoriIds);
                });
            })
            ->latest()
            ->limit(4)
            ->get();

        return view('anggota.buku.show', [
            'buku' => $buku,
            'requestAktif' => $requestAktif,
            'relatedBooks' => $relatedBooks,
        ]);
    }

    public function requestPinjam(Request $request, Buku $buku): RedirectResponse
    {
        $user = $request->user();

        if ($buku->stok < 1) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Stok buku sedang habis.',
            ]);
        }

        $existingRequest = Peminjaman::query()
            ->where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', [Peminjaman::STATUS_MENUNGGU, Peminjaman::STATUS_DIPINJAM])
            ->exists();

        if ($existingRequest) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Anda sudah memiliki request atau pinjaman aktif untuk buku ini.',
            ]);
        }

        Peminjaman::query()->create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now()->toDateString(),
            'jatuh_tempo' => now()->addDays(7)->toDateString(),
            'tanggal_kembali' => null,
            'status' => Peminjaman::STATUS_MENUNGGU,
            'denda' => 0,
        ]);

        return to_route('anggota.buku.show', $buku)->with('status', [
            'type' => 'success',
            'message' => 'Request peminjaman berhasil dikirim ke admin.',
        ]);
    }

    public function pinjamanSaya(Request $request): View
    {
        $peminjaman = Peminjaman::query()
            ->with(['buku.kategori'])
            ->where('user_id', $request->user()->id)
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_PENDING_KEMBALI,
                Peminjaman::STATUS_DIKEMBALIKAN,
            ])
            ->latest()
            ->get();

        return view('anggota.peminjaman.saya', [
            'peminjaman' => $peminjaman,
        ]);
    }

    public function pinjamanSayaShow(Request $request, Peminjaman $peminjaman): View
    {
        abort_unless($peminjaman->user_id === $request->user()->id, 403);

        return view('anggota.peminjaman.show', [
            'peminjaman' => $peminjaman->load(['buku.kategori', 'user']),
        ]);
    }

    public function ajukanKembali(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        abort_unless($peminjaman->user_id === $request->user()->id, 403);
        abort_unless($peminjaman->status === Peminjaman::STATUS_DIPINJAM, 404);

        $peminjaman->update([
            'status' => Peminjaman::STATUS_PENDING_KEMBALI,
        ]);

        return back()->with('status', [
            'type' => 'success',
            'message' => 'Permintaan pengembalian sudah dikirim ke admin.',
        ]);
    }
}
