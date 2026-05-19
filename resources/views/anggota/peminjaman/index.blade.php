<x-anggota-layout>
    <section class="space-y-6">
        <div>
            <p class="page-eyebrow">Peminjaman Buku</p>
            <h1 class="page-title">Cari dan Pinjam Buku</h1>
            <p class="page-subtitle">Jelajahi semua koleksi buku, lalu buka detailnya untuk mengirim request peminjaman.</p>
        </div>

        <div class="table-card">
            <div class="table-toolbar">
                <form action="{{ route('anggota.peminjaman.index') }}" method="GET" class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_320px]">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari judul, pengarang, atau deskripsi buku..."
                            class="form-input pl-11"
                        >
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.4a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-[minmax(0,1fr)_auto] gap-3">
                        <select name="kategori" class="form-input">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected((string) $selectedKategori === (string) $item->id)>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="button-brand">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-6">
                <div class="book-grid">
                    @forelse ($buku as $item)
                        <x-buku-card :buku="$item" />
                    @empty
                        <div class="col-span-full rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center text-slate-500">
                            Tidak ada buku yang sesuai dengan pencarian atau filter kategori.
                        </div>
                    @endforelse
                </div>

                @if ($buku->hasPages())
                    <div class="mt-6">
                        {{ $buku->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-anggota-layout>
