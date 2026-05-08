<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $buku = Buku::query()
            ->with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        return view('buku.index', [
            'buku' => $buku,
            'totalBuku' => Buku::query()->count(),
            'totalStok' => Buku::query()->sum('stok'),
        ]);
    }

    public function create(): View
    {
        return view('buku.create', [
            'kategori' => Kategori::query()->orderBy('nama_kategori')->get(),
            'selectedKategori' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $kategoriIds = $data['kategori'];
        unset($data['kategori']);
        $data['cover'] = $this->storeCover($request);

        $buku = Buku::query()->create($data);
        $buku->kategori()->sync($kategoriIds);

        return to_route('admin.buku.index')->with('status', [
            'type' => 'success',
            'message' => 'Data buku berhasil ditambahkan.',
        ]);
    }

    public function edit(Buku $buku): View
    {
        return view('buku.edit', [
            'buku' => $buku->load('kategori'),
            'kategori' => Kategori::query()->orderBy('nama_kategori')->get(),
            'selectedKategori' => $buku->kategori()->pluck('kategori.id')->all(),
        ]);
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $data = $this->validatedData($request);
        $kategoriIds = $data['kategori'];
        unset($data['kategori']);
        $cover = $this->storeCover($request);

        if ($cover !== null) {
            $this->deleteCover($buku->cover);
            $data['cover'] = $cover;
        } else {
            unset($data['cover']);
        }

        $buku->update($data);
        $buku->kategori()->sync($kategoriIds);

        return to_route('admin.buku.index')->with('status', [
            'type' => 'success',
            'message' => 'Data buku berhasil diperbarui.',
        ]);
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $this->deleteCover($buku->cover);
        $buku->delete();

        return to_route('admin.buku.index')->with('status', [
            'type' => 'success',
            'message' => 'Data buku berhasil dihapus.',
        ]); 
    }

    private function storeCover(Request $request): ?string
    {
        if (! $request->hasFile('cover')) {
            return null;
        }

        return $request->file('cover')->store('cover-buku', 'public');
    }

    private function deleteCover(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'kategori' => ['required', 'array'],
            'kategori.*' => ['exists:kategori,id'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'judul' => ['required', 'string', 'max:255'],
            'pengarang' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tahun_terbit' => ['required', 'integer', 'digits:4'],
            'stok' => ['required', 'integer', 'min:0'],
        ], [
            'kategori.required' => 'Kategori buku wajib dipilih.',
            'kategori.array' => 'Kategori buku harus berupa daftar pilihan.',
            'kategori.*.exists' => 'Salah satu kategori yang dipilih tidak valid.',
            'cover.image' => 'Cover harus berupa gambar.',
            'cover.mimes' => 'Cover harus berformat jpg, jpeg, png, atau webp.',
            'cover.max' => 'Ukuran cover maksimal 2 MB.',
            'judul.required' => 'Judul buku wajib diisi.',
            'pengarang.required' => 'Nama pengarang wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.digits' => 'Tahun terbit harus terdiri dari 4 digit.',
            'stok.required' => 'Stok buku wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
        ]);
    }
}
