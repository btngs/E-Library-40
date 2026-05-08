<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $kategori = Kategori::query()
            ->withCount('buku')
            ->when($search, function ($query, $search) {
                $query->where('nama_kategori', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('kategori.index', [
            'kategori' => $kategori,
            'totalKategori' => Kategori::query()->count(),
            'totalBuku' => Buku::query()->count(),
        ]);
    }

    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Kategori::query()->create($this->validatedData($request));

        return to_route('admin.kategori.index')->with('status', [
            'type' => 'success',
            'message' => 'Data kategori berhasil ditambahkan.',
        ]);
    }

    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $kategori->update($this->validatedData($request, $kategori->id));

        return to_route('admin.kategori.index')->with('status', [
            'type' => 'success',
            'message' => 'Data kategori berhasil diperbarui.',
        ]);
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        if ($kategori->buku()->exists()) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh data buku.',
            ]);
        }

        $kategori->delete();

        return to_route('admin.kategori.index')->with('status', [
            'type' => 'success',
            'message' => 'Data kategori berhasil dihapus.',
        ]);
    }

    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                $ignoreId
                    ? 'unique:kategori,nama_kategori,' . $ignoreId
                    : 'unique:kategori,nama_kategori',
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);
    }
}
