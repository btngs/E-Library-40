<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Master Kategori</p>
            <h2 class="page-title">
                Data Kategori
            </h2>
            <p class="page-subtitle">
                Kelola kategori untuk mengelompokkan buku
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
                    <p class="metric-label metric-label-blue">Total Kategori</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $totalKategori }}</p>
                </div>
                <div class="metric-card metric-card-green">
                    <p class="metric-label metric-label-green">Total Buku</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $totalBuku }}</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.kategori.create') }}" class="button-brand">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Kategori
                            </a>
                        </div>

                        <form action="{{ route('admin.kategori.index') }}" method="GET" class="relative w-full md:w-80">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari nama kategori..." 
                                class="w-full rounded-xl border-slate-200 bg-slate-50 pl-10 pr-4 py-2.5 text-sm focus:border-sky-500 focus:bg-white focus:ring-sky-500 transition-all duration-200"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            @if(request('search'))
                                <a href="{{ route('admin.kategori.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="mt-6">
                        <h3 class="table-toolbar-title font-bold">Daftar Kategori</h3>
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
                                <th class="px-6 py-5 text-left">Nama Kategori</th>
                                <th class="w-40 px-6 py-5">Jumlah Koleksi</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($kategori as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-bold text-slate-900">{{ $item->nama_kategori }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-lg bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-700">
                                            {{ $item->buku_count }} buku
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.kategori.edit', $item) }}" class="button-brand-soft">
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.kategori.destroy', $item) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="button-danger-soft">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada data kategori. Tambahkan kategori pertama untuk memulai.
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
