<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Manajemen</p>
            <h2 class="page-title">Kelola Denda</h2>
            <p class="page-subtitle">Kelola dan selesaikan pembayaran denda anggota.</p>
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
                    <p class="metric-label metric-label-blue">Total Denda Berjalan</p>
                    <p class="mt-3 text-4xl font-semibold">Rp{{ number_format($totalDenda, 0, ',', '.') }}</p>
                </div>
                <div class="metric-card bg-gradient-to-br from-rose-600 to-pink-500">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/80">Anggota Bermasalah</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $totalSiswa }} Orang</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <h3 class="table-toolbar-title font-bold">Daftar Denda Belum Lunas</h3>
                    <p class="table-toolbar-copy">
                        Berikut adalah daftar peminjaman yang memiliki denda yang belum diselesaikan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Anggota</th>
                                <th class="px-6 py-5 text-left">Buku</th>
                                <th class="w-36 px-6 py-5">Jatuh Tempo</th>
                                <th class="w-36 px-6 py-5">Tanggal Kembali</th>
                                <th class="w-36 px-6 py-5 text-right">Jumlah Denda</th>
                                <th class="w-40 px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse($dendaList as $index => $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->user?->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->user?->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $item->buku?->judul ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $item->jatuh_tempo ? $item->jatuh_tempo->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 text-center">
                                        @if($item->tanggal_kembali)
                                            <span class="inline-flex rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                                {{ $item->tanggal_kembali->format('d M Y') }}
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-lg bg-slate-50 px-2.5 py-1 text-xs font-bold text-slate-700">
                                                Belum Kembali
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700">
                                            Rp{{ number_format($item->estimated_denda, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <form action="{{ route('admin.denda.selesaikan', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin denda ini sudah dibayar dan ingin diselesaikan?');">
                                                @csrf
                                                <button type="submit" class="button-brand-soft">
                                                    Selesaikan
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        Saat ini tidak ada denda yang belum lunas.
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
