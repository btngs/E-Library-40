<x-anggota-layout>
    <section class="space-y-8 pb-10">
        <!-- Account Header -->
        <div class="flex flex-col items-center text-center space-y-4 md:flex-row md:text-left md:space-y-0 md:space-x-6 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex h-24 w-24 items-center justify-center rounded-full bg-bento-accent text-3xl font-bold text-white shadow-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="space-y-1">
                <h1 class="text-2xl font-bold text-slate-900">{{ Auth::user()->name }}</h1>
                <p class="text-slate-500 font-medium">{{ Auth::user()->email }}</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-[#3552d4] bg-opacity-10 text-[#3552d4] text-xs font-bold uppercase tracking-wider">Siswa</span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-wider">SMKN 40 JAKARTA</span>
                </div>
            </div>
        </div>

        <div>
            <p class="page-eyebrow">Ringkasan Aktivitas</p>
            <h2 class="text-xl font-bold text-slate-900">Statistik Peminjaman</h2>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="metric-card metric-card-blue">
                <p class="metric-label metric-label-blue">Pinjam 1 Bulan</p>
                <p class="mt-3 text-4xl font-semibold">{{ $totalPinjamSebulan }}</p>
            </div>
            <div class="metric-card metric-card-green">
                <p class="metric-label metric-label-green">Sedang Dipinjam</p>
                <p class="mt-3 text-4xl font-semibold">{{ $totalAktif }}</p>
            </div>
            <div class="metric-card bg-amber-600">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/80">Tagihan Denda</p>
                <p class="mt-3 text-4xl font-semibold text-white">Rp{{ number_format($totalDenda, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="table-card">
            <div class="table-toolbar">
                <h2 class="table-toolbar-title">Grafik Peminjaman Pekanan</h2>
                <p class="table-toolbar-copy">Aktivitas peminjaman buku Anda dalam 4 minggu terakhir.</p>
            </div>

            <div class="chart-shell overflow-x-auto">
                <div class="flex items-end justify-between gap-4 min-w-[300px] w-full">
                    @foreach ($chartData as $index => $value)
                        <div class="chart-bar-group">
                            <div class="chart-bar-track">
                                <div class="chart-bar-fill" style="height: {{ max(10, (int) round(($value / max(1, $maxChartValue)) * 100)) }}%"></div>
                            </div>
                            <span class="chart-bar-value">{{ $value }}</span>
                            <span class="chart-bar-label">{{ $chartLabels[$index] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Account Actions -->
        <div class="pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 px-6 py-4 rounded-xl bg-rose-50 text-rose-600 font-bold hover:bg-rose-100 transition duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar dari Aplikasi
                </button>
            </form>
        </div>
    </section>
</x-anggota-layout>
