@props(['buku'])

<a href="{{ route('anggota.buku.show', $buku) }}" {{ $attributes->merge(['class' => 'book-card group']) }}>
    <div class="book-card-cover-shell">
        @if ($buku->cover)
            <img
                src="{{ asset('storage/' . $buku->cover) }}"
                alt="Cover {{ $buku->judul }}"
                class="book-card-cover"
            >
        @else
            <div class="book-card-cover book-card-cover-fallback">
                <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
        @endif
    </div>

    <div class="flex flex-1 flex-col justify-between">
        <div class="space-y-2">
            <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-[0.1em]">
                <span class="text-sky-600 truncate max-w-[70%]">
                    {{ $buku->kategori->first()?->nama_kategori ?? 'Umum' }}
                </span>
                <span class="{{ $buku->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }}
                </span>
            </div>

            <div>
                <h3 class="book-card-title line-clamp-2 min-h-[2.5rem]">{{ $buku->judul }}</h3>
                <p class="book-card-meta truncate">{{ $buku->pengarang }}</p>
            </div>
        </div>

        <p class="book-card-copy mt-3 hidden sm:line-clamp-3">
            {{ $buku->deskripsi ?: 'Informasi deskripsi buku belum tersedia.' }}
        </p>
    </div>
</a>
