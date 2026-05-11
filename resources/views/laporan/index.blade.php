<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Analisis</p>
            <h2 class="page-title">Laporan Bulanan</h2>
            <p class="page-subtitle">Rekapitulasi aktivitas peminjaman dan denda per bulan.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="page-wrapper space-y-6">
            
            <div class="grid gap-4 md:grid-cols-2">
                <div class="metric-card metric-card-blue">
                    <p class="metric-label metric-label-blue">Total Peminjaman ({{ date('Y') }})</p>
                    <p class="mt-3 text-4xl font-semibold">{{ number_format($totalPinjamTahunIni) }}</p>
                    <p class="mt-2 text-xs text-slate-500">Seluruh transaksi peminjaman tahun ini.</p>
                </div>
                <div class="metric-card metric-card-green">
                    <p class="metric-label metric-label-green">Total Denda Lunas ({{ date('Y') }})</p>
                    <p class="mt-3 text-4xl font-semibold">Rp{{ number_format($totalDendaTahunIni, 0, ',', '.') }}</p>
                    <p class="mt-2 text-xs text-slate-500">Akumulasi pendapatan denda yang telah dibayar.</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <h3 class="table-toolbar-title font-bold">Data Rekapitulasi Bulanan</h3>
                    <p class="table-toolbar-copy">
                        Data dikelompokkan berdasarkan bulan dan tahun transaksi dibuat.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="table-head">
                            <tr>
                                <th class="px-6 py-5">Bulan</th>
                                <th class="px-6 py-5 text-center">Tahun</th>
                                <th class="px-6 py-5 text-center">Total Pinjam</th>
                                <th class="px-6 py-5 text-right">Denda Lunas</th>
                                <th class="px-6 py-5 text-right text-rose-600">Denda Berjalan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($rekapBulanan as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-5 font-bold text-slate-900">
                                        {{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}
                                    </td>
                                    <td class="px-6 py-5 text-center text-slate-500">
                                        {{ $item->tahun }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center rounded-md bg-sky-50 px-2 py-1 text-xs font-medium text-sky-700 ring-1 ring-inset ring-sky-700/10">
                                            {{ $item->total_pinjam }} Transaksi
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right font-medium text-emerald-600">
                                        Rp{{ number_format($item->total_denda_lunas, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5 text-right font-medium text-rose-600">
                                        Rp{{ number_format($item->total_denda_berjalan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-500 italic">
                                        Belum ada data transaksi untuk ditampilkan.
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
