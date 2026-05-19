<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Dashboard Peminjaman</p>
            <h2 class="page-title">Peminjaman Buku</h2>
            <p class="page-subtitle">
                Pantau request dari anggota dan lihat daftar buku yang sedang dipinjam.
            </p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="page-wrapper space-y-6" x-data="{ tab: '{{ $activeTab }}' }">
            @if (session('status'))
                <div class="status-banner">
                    {{ session('status.message') }}
                </div>
            @endif

            @if ($totalPendingKembali > 0)
                <div class="status-banner status-banner-error flex items-center justify-between gap-3">
                    <span>Ada {{ $totalPendingKembali }} request pengembalian menunggu verifikasi.</span>
                    <span class="rounded-md bg-white px-3 py-1 text-xs font-bold text-rose-700 border border-rose-200">
                        Pending
                    </span>
                </div>
            @endif

            <div class="grid gap-4 md:grid-cols-3">
                <div class="metric-card metric-card-blue">
                    <p class="metric-label metric-label-blue">Request Masuk</p>
                    <p class="mt-3 text-4xl font-semibold text-white">{{ $totalRequest }}</p>
                </div>
                <div class="metric-card metric-card-green">
                    <p class="metric-label metric-label-green">Sedang Dipinjam</p>
                    <p class="mt-3 text-4xl font-semibold text-white">{{ $totalDipinjam }}</p>
                </div>
                <div class="metric-card bg-rose-600">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/80">Terlambat</p>
                    <p class="mt-3 text-4xl font-semibold text-white">{{ $totalTerlambat }}</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <h3 class="table-toolbar-title font-bold text-slate-950">Daftar Peminjaman</h3>
                            <p class="table-toolbar-copy">
                                Gunakan tombol di bawah untuk berpindah antara notifikasi request dan data buku yang aktif dipinjam.
                            </p>
                        </div>

                        <div class="inline-flex rounded-xl bg-slate-100 p-1">
                            <button @click="tab = 'request'" :class="tab === 'request' ? 'bg-white shadow-sm text-slate-950' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-sm font-bold transition">
                                Request Pinjam
                            </button>
                            <button @click="tab = 'pinjam'" :class="tab === 'pinjam' ? 'bg-white shadow-sm text-slate-950' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-sm font-bold transition">
                                Sedang Dipinjam
                            </button>
                            <button @click="tab = 'pending'" :class="tab === 'pending' ? 'bg-white shadow-sm text-slate-950' : 'text-slate-500'" class="rounded-lg px-4 py-2 text-sm font-bold transition">
                                Pengembalian
                                @if ($totalPendingKembali > 0)
                                    <span class="ml-2 inline-flex h-5 min-w-5 items-center justify-center rounded-md bg-rose-600 px-1.5 text-[11px] font-bold text-white">
                                        {{ $totalPendingKembali }}
                                    </span>
                                @endif
                            </button>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-3 border-b border-slate-100 flex justify-end bg-slate-50/30" x-show="tab === 'pinjam'" x-cloak>
                    <a href="{{ route('admin.peminjaman.create') }}" class="button-brand !px-4 !py-2 text-xs">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Peminjaman
                    </a>
                </div>

                <div x-show="tab === 'request'" x-cloak class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Anggota</th>
                                <th class="px-6 py-5 text-left">Buku</th>
                                <th class="w-36 px-6 py-5">Tanggal Request</th>
                                <th class="w-36 px-6 py-5">Batas Pinjam</th>
                                <th class="w-32 px-6 py-5 text-center">Status</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($requestPinjam as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->user?->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->user?->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->buku?->judul ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->buku?->kategori?->pluck('nama_kategori')->join(', ') ?: '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ optional($item->created_at)->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->jatuh_tempo?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-lg bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('admin.peminjaman.approve', $item) }}">
                                                @csrf
                                                <button type="submit" class="button-brand-soft">
                                                    Terima
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.peminjaman.reject', $item) }}" onsubmit="return confirm('Tolak request peminjaman ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-danger-soft">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada request peminjaman dari anggota.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div x-show="tab === 'pinjam'" x-cloak class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Anggota</th>
                                <th class="px-6 py-5 text-left">Buku</th>
                                <th class="w-36 px-6 py-5">Tanggal Pinjam</th>
                                <th class="w-36 px-6 py-5">Jatuh Tempo</th>
                                <th class="w-32 px-6 py-5 text-center">Status</th>
                                <th class="w-28 px-6 py-5 text-right">Denda</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($sedangDipinjam as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->user?->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->user?->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->buku?->judul ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->buku?->kategori?->pluck('nama_kategori')->join(', ') ?: '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->jatuh_tempo?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-lg bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-700">
                                            Dipinjam
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-slate-900">
                                        Rp{{ number_format($item->denda ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada buku yang sedang dipinjam.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div x-show="tab === 'pending'" x-cloak class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Anggota</th>
                                <th class="px-6 py-5 text-left">Buku</th>
                                <th class="w-36 px-6 py-5">Tanggal Pinjam</th>
                                <th class="w-36 px-6 py-5">Jatuh Tempo</th>
                                <th class="w-32 px-6 py-5 text-center">Status</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($pendingKembali as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->user?->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->user?->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->buku?->judul ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->buku?->kategori?->pluck('nama_kategori')->join(', ') ?: '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->jatuh_tempo?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-lg bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                            Request Pengembalian
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('admin.peminjaman.confirm-return', $item) }}">
                                                @csrf
                                                <button type="submit" class="button-brand-soft">
                                                    Konfirmasi
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.peminjaman.reject-return', $item) }}">
                                                @csrf
                                                <button type="submit" class="button-danger-soft">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada pengembalian pending.
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
