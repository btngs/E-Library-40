<div class="space-y-8">
    <!-- Informasi Utama -->
    <div class="space-y-6">
        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
            <div class="p-2 bg-sky-50 rounded-lg">
                <svg class="h-4 w-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Informasi Buku</h4>
        </div>

        <div class="grid gap-6">
            <div>
                <x-input-label for="judul" :value="'Judul Lengkap Buku'" />
                <x-text-input
                    id="judul"
                    name="judul"
                    type="text"
                    class="mt-1"
                    :value="old('judul', $buku->judul ?? '')"
                    placeholder="Masukkan judul buku..."
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="pengarang" :value="'Nama Pengarang'" />
                    <x-text-input
                        id="pengarang"
                        name="pengarang"
                        type="text"
                        class="mt-1"
                        :value="old('pengarang', $buku->pengarang ?? '')"
                        placeholder="Nama penulis..."
                        required
                    />
                    <x-input-error :messages="$errors->get('pengarang')" class="mt-2" />
                </div>

                <div>
                    @php
                        $checkedKategori = collect(old('kategori', $selectedKategori ?? []))->map(fn ($id) => (string) $id)->all();
                    @endphp
                    <x-input-label :value="'Kategori Buku'" />
                    <div class="mt-2 grid gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:grid-cols-2">
                        @foreach ($kategori as $item)
                            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 transition hover:border-sky-200 hover:bg-sky-50">
                                <input
                                    type="checkbox"
                                    name="kategori[]"
                                    value="{{ $item->id }}"
                                    class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500"
                                    @checked(in_array((string) $item->id, $checkedKategori, true))
                                >
                                <span>{{ $item->nama_kategori }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    <x-input-error :messages="$errors->get('kategori.*')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="deskripsi" :value="'Deskripsi Buku'" />
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm transition focus:border-sky-500 focus:bg-white focus:ring-sky-500"
                    placeholder="Tulis ringkasan atau sinopsis buku di sini..."
                >{{ old('deskripsi', $buku->deskripsi ?? '') }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>
        </div>
    </div>

    <!-- Detail Koleksi -->
    <div class="space-y-6">
        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
            <div class="p-2 bg-amber-50 rounded-lg">
                <svg class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Detail Koleksi</h4>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="tahun_terbit" :value="'Tahun Terbit'" />
                <x-text-input
                    id="tahun_terbit"
                    name="tahun_terbit"
                    type="number"
                    min="1000"
                    max="9999"
                    class="mt-1"
                    :value="old('tahun_terbit', $buku->tahun_terbit ?? '')"
                    placeholder="YYYY"
                    required
                />
                <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="stok" :value="'Jumlah Stok'" />
                <x-text-input
                    id="stok"
                    name="stok"
                    type="number"
                    min="0"
                    class="mt-1"
                    :value="old('stok', $buku->stok ?? '')"
                    placeholder="0"
                    required
                />
                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
            </div>
        </div>
    </div>

    <!-- Media -->
    <div class="space-y-6">
        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
            <div class="p-2 bg-emerald-50 rounded-lg">
                <svg class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Cover Buku</h4>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="shrink-0">
                    <div class="relative group">
                        @if (! empty($buku?->cover))
                            <img
                                src="{{ asset('storage/' . $buku->cover) }}"
                                alt="Cover saat ini"
                                class="h-48 w-32 rounded-xl object-cover shadow-lg ring-4 ring-white"
                            >
                            <div class="absolute inset-0 rounded-xl bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white text-[10px] font-bold uppercase tracking-widest">Cover Aktif</span>
                            </div>
                        @else
                            <div class="h-48 w-32 rounded-xl bg-slate-200 flex flex-col items-center justify-center border-2 border-dashed border-slate-300">
                                <svg class="h-10 w-10 text-slate-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">No Cover</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex-1 space-y-4">
                    <x-input-label for="cover" :value="'Pilih File Cover Baru'" />
                    <input
                        id="cover"
                        name="cover"
                        type="file"
                        accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-slate-950 file:text-white hover:file:bg-slate-800 transition-all cursor-pointer"
                    >
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <svg class="h-3 w-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Format: JPG, JPEG, PNG, atau WEBP
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <svg class="h-3 w-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Ukuran maksimal: 2 MB
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>
</div>
