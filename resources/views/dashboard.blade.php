<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Ringkasan Sistem</p>
            <h2 class="page-title">Dashboard</h2>
            <p class="page-subtitle">Selamat datang kembali, {{ Auth::user()->name }}. Berikut adalah ringkasan perpustakaan Anda.</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Quick Access Section -->
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('admin.buku.create') }}" class="flex items-center p-6 bg-white rounded-3xl border border-slate-200 shadow-sm hover:border-sky-500 hover:shadow-md transition-all group">
                <div class="p-4 bg-sky-50 rounded-2xl group-hover:bg-sky-500 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6 text-sky-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold text-slate-900">Tambah Buku</h3>
                    <p class="text-sm text-slate-500">Input koleksi buku baru ke sistem</p>
                </div>
            </a>

            <a href="{{ route('admin.kategori.create') }}" class="flex items-center p-6 bg-white rounded-3xl border border-slate-200 shadow-sm hover:border-amber-500 hover:shadow-md transition-all group">
                <div class="p-4 bg-amber-50 rounded-2xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6 text-amber-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold text-slate-900">Tambah Kategori</h3>
                    <p class="text-sm text-slate-500">Buat kategori baru untuk pengelompokan</p>
                </div>
            </a>

            <a href="{{ route('admin.anggota.create') }}" class="flex items-center p-6 bg-white rounded-3xl border border-slate-200 shadow-sm hover:border-rose-500 hover:shadow-md transition-all group">
                <div class="p-4 bg-rose-50 rounded-2xl group-hover:bg-rose-500 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6 text-rose-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.75a6 6 0 00-12 0M12 12a4.5 4.5 0 100-9m7.5 4.5v3m0 0v3m0-3h-3m3 0h3" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold text-slate-900">Tambah Anggota</h3>
                    <p class="text-sm text-slate-500">Buat akun siswa baru dari dashboard admin</p>
                </div>
            </a>

            <a href="{{ route('admin.peminjaman.index') }}" class="flex items-center p-6 bg-white rounded-3xl border border-slate-200 shadow-sm hover:border-emerald-500 hover:shadow-md transition-all group">
                <div class="p-4 bg-emerald-50 rounded-2xl group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6 text-emerald-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13.5V9.75a1.5 1.5 0 113 0v3.75m-3 0a1.5 1.5 0 003 0m-3 0v6m3-6v6m3-9h-6a2.25 2.25 0 00-2.25 2.25v6A2.25 2.25 0 009 20.25h6A2.25 2.25 0 0017.25 18v-6A2.25 2.25 0 0015 9.75z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold text-slate-900">Peminjaman</h3>
                    <p class="text-sm text-slate-500">Pantau request dan buku yang sedang dipinjam</p>
                </div>
            </a>
        </div>

        <!-- Stats Section -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="metric-card bg-gradient-to-br from-blue-600 to-sky-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-white/80">Total Buku</p>
                        <p class="mt-2 text-3xl font-bold">{{ $totalBuku }}</p>
                    </div>
                    <div class="p-2 bg-white/20 rounded-xl">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="metric-card bg-gradient-to-br from-emerald-600 to-teal-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-white/80">Total Stok</p>
                        <p class="mt-2 text-3xl font-bold">{{ $totalStok }}</p>
                    </div>
                    <div class="p-2 bg-white/20 rounded-xl">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="metric-card bg-gradient-to-br from-purple-600 to-indigo-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-white/80">Kategori</p>
                        <p class="mt-2 text-3xl font-bold">{{ $totalKategori }}</p>
                    </div>
                    <div class="p-2 bg-white/20 rounded-xl">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="metric-card bg-gradient-to-br from-rose-600 to-pink-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-white/80">Total User</p>
                        <p class="mt-2 text-3xl font-bold">{{ $totalUser }}</p>
                    </div>
                    <div class="p-2 bg-white/20 rounded-xl">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Top 5 Buku Populer -->
            <div class="lg:col-span-1">
                <div class="table-card">
                    <div class="table-toolbar">
                        <h3 class="text-lg font-bold text-slate-900">🏆 Top 5 Buku Populer</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-4">
                            @forelse($bukuPopuler as $index => $book)
                                <div class="flex items-center gap-3">
                                    <div @class([
                                        'h-10 w-10 rounded-full flex items-center justify-center text-sm font-bold shrink-0',
                                        'bg-amber-100 text-amber-600'  => $index === 0,
                                        'bg-slate-200 text-slate-600'  => $index === 1,
                                        'bg-orange-100 text-orange-600' => $index === 2,
                                        'bg-sky-100 text-sky-600'       => $index >= 3,
                                    ])>
                                        #{{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 truncate">{{ $book->judul }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ $book->pengarang }}</p>
                                    </div>
                                    <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                        {{ $book->peminjaman_count }}x
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-slate-400 text-center py-4">Belum ada data peminjaman.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Histori Peminjaman -->
            <div class="lg:col-span-2">
                <div class="table-card h-full">
                    <div class="table-toolbar flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-900">Histori Peminjaman</h3>
                        <a href="{{ route('admin.peminjaman.index') }}" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                            Buka Peminjaman
                        </a>
                    </div>
                    <div class="flex flex-col items-center justify-center p-12 text-center h-[300px]">
                        <div class="p-4 bg-emerald-50 rounded-full mb-4">
                            <svg class="h-12 w-12 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 6.75h13.5M8.25 12h13.5m-13.5 5.25h13.5M4.5 6.75h.008v.008H4.5V6.75zm0 5.25h.008v.008H4.5V12zm0 5.25h.008v.008H4.5v-.008z" />
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">Peminjaman Siap Dipantau</h4>
                        <p class="text-xs text-slate-500 mt-1 max-w-[240px]">Buka halaman peminjaman untuk melihat request masuk dan buku yang sedang dipinjam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
