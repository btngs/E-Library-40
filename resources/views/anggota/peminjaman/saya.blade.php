<x-anggota-layout>
    <section class="space-y-6">
        <div>
            <p class="page-eyebrow">Peminjaman Saya</p>
            <h1 class="page-title">Buku yang Sedang Dipinjam</h1>
            <p class="page-subtitle">Daftar buku aktif yang sedang Anda pinjam saat ini.</p>
        </div>

        @if (session('status'))
            <div class="status-banner {{ session('status.type') === 'error' ? 'status-banner-error' : '' }}">
                {{ session('status.message') }}
            </div>
        @endif

        <div class="book-grid">
            @forelse ($peminjaman as $item)
                <a href="{{ route('anggota.peminjaman.saya.show', $item) }}" class="group block">
                    <div class="book-card h-full">
                        @php
                            $statusLabel = match ($item->status) {
                                \App\Models\Peminjaman::STATUS_DIPINJAM => 'Dipinjam',
                                \App\Models\Peminjaman::STATUS_PENDING_KEMBALI => 'Menunggu Konfirmasi',
                                \App\Models\Peminjaman::STATUS_DIKEMBALIKAN => 'Dikembalikan',
                                default => ucfirst($item->status),
                            };
                            $statusClass = match ($item->status) {
                                \App\Models\Peminjaman::STATUS_DIPINJAM => 'bg-[#3552d4] bg-opacity-10 text-[#3552d4]',
                                \App\Models\Peminjaman::STATUS_PENDING_KEMBALI => 'bg-amber-50 text-amber-700',
                                \App\Models\Peminjaman::STATUS_DIKEMBALIKAN => 'bg-emerald-50 text-emerald-700',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp

                        <div class="book-card-cover-shell">
                            @if ($item->buku?->cover)
                                <img src="{{ asset('storage/' . $item->buku->cover) }}" alt="Cover {{ $item->buku->judul }}" class="book-card-cover">
                            @else
                                <div class="book-card-cover book-card-cover-fallback">
                                    <svg class="h-14 w-14 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-3">
                            <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>

                            <div>
                                <h2 class="book-card-title group-hover:text-bento-accent">{{ $item->buku?->judul ?? '-' }}</h2>
                                <p class="book-card-meta">{{ $item->buku?->pengarang ?? '-' }}</p>
                            </div>

                            <div class="space-y-2 text-sm text-slate-600">
                                <div class="flex items-center justify-between gap-3">
                                    <span>Tanggal pinjam</span>
                                    <span class="font-semibold text-slate-900">{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <span>Jatuh tempo</span>
                                    <span class="font-semibold text-slate-900">{{ $item->jatuh_tempo?->format('d M Y') ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="pt-1">
                                @if ($item->status === \App\Models\Peminjaman::STATUS_DIPINJAM)
                                    <form method="POST" action="{{ route('anggota.peminjaman.saya.kembalikan', $item) }}" onclick="event.stopPropagation();">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="button-brand w-full">
                                            Kembalikan
                                        </button>
                                    </form>
                                @elseif ($item->status === \App\Models\Peminjaman::STATUS_PENDING_KEMBALI)
                                    <button type="button" class="button-muted w-full" disabled>
                                        Menunggu Konfirmasi
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('anggota.buku.request', $item->buku_id) }}" onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit" class="button-brand w-full">
                                            Pinjam Kembali
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center text-slate-500">
                    Tidak ada buku yang sedang Anda pinjam.
                </div>
            @endforelse
        </div>
    </section>
</x-anggota-layout>
