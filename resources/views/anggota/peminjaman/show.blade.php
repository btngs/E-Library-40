<x-anggota-layout>
    <section class="space-y-8">
        @if (session('status'))
            <div class="status-banner {{ session('status.type') === 'error' ? 'status-banner-error' : '' }}">
                {{ session('status.message') }}
            </div>
        @endif

        <div class="detail-shell">
            <div class="detail-cover-shell">
                @if ($peminjaman->buku?->cover)
                    <img src="{{ asset('storage/' . $peminjaman->buku->cover) }}" alt="Cover {{ $peminjaman->buku->judul }}" class="detail-cover">
                @else
                    <div class="detail-cover detail-cover-fallback">
                        <svg class="h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="space-y-3">
                    @php
                        $statusLabel = match ($peminjaman->status) {
                            \App\Models\Peminjaman::STATUS_DIPINJAM => 'Dipinjam',
                            \App\Models\Peminjaman::STATUS_PENDING_KEMBALI => 'Menunggu Konfirmasi',
                            \App\Models\Peminjaman::STATUS_DIKEMBALIKAN => 'Dikembalikan',
                            default => ucfirst($peminjaman->status),
                        };
                        $statusClass = match ($peminjaman->status) {
                            \App\Models\Peminjaman::STATUS_DIPINJAM => 'bg-sky-50 text-sky-700',
                            \App\Models\Peminjaman::STATUS_PENDING_KEMBALI => 'bg-amber-50 text-amber-700',
                            \App\Models\Peminjaman::STATUS_DIKEMBALIKAN => 'bg-emerald-50 text-emerald-700',
                            default => 'bg-slate-100 text-slate-600',
                        };
                    @endphp

                    <div class="flex flex-wrap gap-3">
                        @forelse ($peminjaman->buku?->kategori ?? collect() as $kategori)
                            <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-sky-700">
                                {{ $kategori->nama_kategori }}
                            </span>
                        @empty
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                Tanpa Kategori
                            </span>
                        @endforelse
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div>
                        <h1 class="page-title">{{ $peminjaman->buku?->judul ?? '-' }}</h1>
                        <p class="text-base text-slate-500">{{ $peminjaman->buku?->pengarang ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="info-chip">
                        <span class="info-chip-label">Tanggal Pinjam</span>
                        <span class="info-chip-value">{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label">Jatuh Tempo</span>
                        <span class="info-chip-value">{{ $peminjaman->jatuh_tempo?->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label">Status</span>
                        <span class="info-chip-value">{{ $statusLabel }}</span>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Detail Buku</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        {{ $peminjaman->buku?->deskripsi ?: 'Deskripsi buku belum tersedia.' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    @if ($peminjaman->status === \App\Models\Peminjaman::STATUS_DIPINJAM)
                        <form method="POST" action="{{ route('anggota.peminjaman.saya.kembalikan', $peminjaman) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button-brand">
                                Kembalikan Buku
                            </button>
                        </form>
                    @elseif ($peminjaman->status === \App\Models\Peminjaman::STATUS_PENDING_KEMBALI)
                        <button type="button" class="button-muted" disabled>
                            Menunggu Konfirmasi
                        </button>
                    @else
                        <form method="POST" action="{{ route('anggota.buku.request', $peminjaman->buku_id) }}">
                            @csrf
                            <button type="submit" class="button-brand">
                                Pinjam Kembali
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('anggota.peminjaman.saya') }}" class="btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-anggota-layout>
