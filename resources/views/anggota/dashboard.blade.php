<x-anggota-layout>
    <section class="space-y-10">
        <div class="member-hero-full">
            <div class="member-hero-bg">
                <div class="member-hero-inner">
                    <div class="space-y-6 text-center md:space-y-7 md:text-left">
                        <p class="member-hero-eyebrow">Selamat Datang</p>
                        <h1 class="member-hero-title">
                            Halo, {{ Auth::user()->name }}<br>
                            Selamat Membaca
                        </h1>
                        <p class="member-hero-copy mx-auto md:mx-0">
                            Temukan koleksi terbaik, jelajahi buku terbaru, dan mulai aktivitas membaca dari dashboard anggota.
                        </p>
                        
                        <div class="member-hero-search-wrap mx-auto md:mx-0">
                            <form action="{{ route('anggota.peminjaman.index') }}" method="GET" class="member-hero-search">
                                <label for="hero-search" class="sr-only">Cari buku</label>
                                <span class="member-hero-search-icon" aria-hidden="true">
                                    <svg viewBox="0 0 20 20" fill="none" class="h-5 w-5">
                                        <path d="M8.5 14.5a6 6 0 1 1 0-12 6 6 0 0 1 0 12Z" stroke="currentColor" stroke-width="1.8" />
                                        <path d="M13 13l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <input
                                    id="hero-search"
                                    type="text"
                                    name="q"
                                    value="{{ request('q') }}"
                                    placeholder="Cari judul buku atau penulis"
                                    class="member-hero-search-input"
                                >
                                <button type="submit" class="member-hero-search-button">
                                    Cari
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="flex justify-center lg:justify-end">
                        <img
                            src="{{ asset('images/hero-image.png') }}"
                            alt="Ilustrasi hero"
                            class="member-hero-illustration"
                        >
                    </div>
                </div>

                <div class="member-hero-stats-wrap">
                    <div class="member-hero-stats">


                        <div class="member-hero-stat">
                            <p class="member-hero-stat-label text-sky-600">Total Buku</p>
                            <p class="member-hero-stat-value">{{ $totalBuku }}</p>
                        </div>

                        <div class="member-hero-stat">
                            <p class="member-hero-stat-label text-blue-600">Total Siswa</p>
                            <p class="member-hero-stat-value">{{ $totalUser }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <section class="space-y-5">
            <div class="section-heading">
                <div>
                    <p class="page-eyebrow">Pilihan Anggota</p>
                    <h2 class="page-title text-2xl">Buku Populer</h2>
                </div>
            </div>

            <div class="book-grid">
                @forelse ($bukuPopuler as $item)
                    <x-buku-card :buku="$item" />
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center text-slate-500 lg:col-span-4">
                        Belum ada buku populer untuk ditampilkan.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="space-y-5">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="page-eyebrow">Koleksi Terbaru</p>
                    <h2 class="page-title text-2xl">Buku Baru</h2>
                </div>
                <a href="{{ route('anggota.peminjaman.index') }}" class="button-brand-soft !px-4 !py-2">
                    Lihat Semua
                </a>
            </div>

            <div class="book-grid">
                @forelse ($bukuTerbaru as $item)
                    <x-buku-card :buku="$item" />
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center text-slate-500 lg:col-span-4">
                        Belum ada buku terbaru untuk ditampilkan.
                    </div>
                @endforelse
            </div>
        </section>
    </section>
</x-anggota-layout>
