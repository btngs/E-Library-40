<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Dashboard Buku</p>
            <h2 class="page-title">
                Data Buku
            </h2>
            <p class="page-subtitle">
                Kelola koleksi buku perpustakaan SMKN 40
            </p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="page-wrapper space-y-6">
            @if (session('status'))
                <div class="status-banner">
                    {{ session('status.message') }}
                </div>
            @endif

            <div class="grid gap-4 md:grid-cols-2">
                <div class="metric-card metric-card-blue">
                    <p class="metric-label metric-label-blue">Total Buku</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $totalBuku }}</p>
                </div>
                <div class="metric-card metric-card-green">
                    <p class="metric-label metric-label-green">Total Stok</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $totalStok }}</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.buku.create') }}" class="button-brand">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Buku
                            </a>
                        </div>

                        <form action="{{ route('admin.buku.index') }}" method="GET" class="relative w-full md:w-80">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari judul, pengarang..." 
                                class="w-full rounded-xl border-slate-200 bg-slate-50 pl-10 pr-4 py-2.5 text-sm focus:border-sky-500 focus:bg-white focus:ring-sky-500 transition-all duration-200"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            @if(request('search'))
                                <a href="{{ route('admin.buku.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="mt-6">
                        <h3 class="table-toolbar-title font-bold">Daftar Koleksi Buku</h3>
                        @if(request('search'))
                            <p class="table-toolbar-copy">
                                Menampilkan hasil pencarian untuk "<span class="font-bold text-slate-900">{{ request('search') }}</span>"
                            </p>
                        @endif
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="w-24 px-6 py-5">Cover</th>
                                <th class="px-6 py-5">Judul & Pengarang</th>
                                <th class="px-6 py-5">Deskripsi</th>
                                <th class="px-6 py-5">Kategori</th>
                                <th class="w-28 px-6 py-5 text-center">Stok</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($buku as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        @if ($item->cover)
                                            <img
                                                src="{{ asset('storage/' . $item->cover) }}"
                                                alt="Cover {{ $item->judul }}"
                                                class="h-16 w-11 rounded-lg object-cover shadow-sm ring-1 ring-slate-100"
                                            >
                                        @else
                                            <div class="h-16 w-11 rounded-lg bg-slate-50 flex items-center justify-center border border-dashed border-slate-200">
                                                <svg class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900 line-clamp-1">{{ $item->judul }}</div>
                                        <div class="text-xs text-slate-500 mt-1 italic">{{ $item->pengarang }} ({{ $item->tahun_terbit }})</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed max-w-xs">
                                            {{ $item->deskripsi ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @forelse ($item->kategori as $kategori)
                                                <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">
                                                    {{ $kategori->nama_kategori }}
                                                </span>
                                            @empty
                                                <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-400">
                                                    -
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                            {{ $item->stok }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.buku.edit', $item) }}" class="button-brand-soft">
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.buku.destroy', $item) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="button-danger-soft"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada data buku. Tambahkan buku pertama untuk memulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
