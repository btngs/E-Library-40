<x-anggota-layout>
    <section class="space-y-8">
        @if (session('status'))
            <div class="status-banner {{ session('status.type') === 'error' ? 'status-banner-error' : '' }}">
                {{ session('status.message') }}
            </div>
        @endif

        <div class="detail-shell">
            <div class="detail-cover-shell">
                @if ($buku->cover)
                    <img
                        src="{{ asset('storage/' . $buku->cover) }}"
                        alt="Cover {{ $buku->judul }}"
                        class="detail-cover"
                    >
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
                    <div class="flex flex-wrap gap-3">
                        @forelse ($buku->kategori as $kategori)
                            <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-sky-700">
                                {{ $kategori->nama_kategori }}
                            </span>
                        @empty
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                Tanpa Kategori
                            </span>
                        @endforelse
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $buku->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $buku->stok > 0 ? 'Stok tersedia: ' . $buku->stok : 'Stok habis' }}
                        </span>
                    </div>

                    <div>
                        <h1 class="page-title">{{ $buku->judul }}</h1>
                        <p class="text-base text-slate-500">{{ $buku->pengarang }} • {{ $buku->tahun_terbit }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="info-chip">
                        <span class="info-chip-label">Pengarang</span>
                        <span class="info-chip-value">{{ $buku->pengarang }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label">Tahun</span>
                        <span class="info-chip-value">{{ $buku->tahun_terbit }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label">Kategori</span>
                        <span class="info-chip-value">
                            {{ $buku->kategori->pluck('nama_kategori')->join(', ') ?: '-' }}
                        </span>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Deskripsi Buku</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        {{ $buku->deskripsi ?: 'Deskripsi buku belum tersedia.' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    @if ($requestAktif?->status === \App\Models\Peminjaman::STATUS_MENUNGGU)
                        <button type="button" class="button-muted" disabled>Request Sedang Diproses</button>
                    @elseif ($requestAktif?->status === \App\Models\Peminjaman::STATUS_DIPINJAM)
                        <button type="button" class="button-muted" disabled>Buku Sedang Anda Pinjam</button>
                    @elseif ($buku->stok < 1)
                        <button type="button" class="button-muted" disabled>Stok Habis</button>
                    @else
                        <form method="POST" action="{{ route('anggota.buku.request', $buku) }}">
                            @csrf
                            <button type="submit" class="button-brand">
                                Pinjam Buku
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('anggota.peminjaman.index') }}" class="btn-secondary">
                        Kembali ke Koleksi
                    </a>
                </div>
            </div>
        </div>

        @if ($relatedBooks->isNotEmpty())
            <section class="space-y-5">
                <div>
                    <p class="page-eyebrow">Rekomendasi</p>
                    <h2 class="page-title text-2xl">Buku Lainnya</h2>
                </div>

                <div class="book-grid">
                    @foreach ($relatedBooks as $item)
                        <x-buku-card :buku="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </section>
</x-anggota-layout>
