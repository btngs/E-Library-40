<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Form Kategori</p>
            <h2 class="page-title">Tambah Kategori</h2>
            <p class="page-subtitle">Buat kategori baru untuk mengelompokkan buku.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Tambah Kategori Baru</h3>
                    <p class="form-shell-copy">Isi nama kategori dengan singkat dan jelas.</p>
                </div>

                <form method="POST" action="{{ route('admin.kategori.store') }}" class="form-shell-body">
                    @csrf

                    <div class="space-y-6">
                        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                            <div class="p-2 bg-sky-50 rounded-lg">
                                <svg class="h-4 w-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Identitas Kategori</h4>
                        </div>

                        <div>
                            <x-input-label for="nama_kategori" :value="'Nama Kategori'" />
                            <x-text-input
                                id="nama_kategori"
                                name="nama_kategori"
                                type="text"
                                class="mt-1"
                                :value="old('nama_kategori')"
                                placeholder="Contoh: Pemrograman, Novel, Sejarah..."
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.kategori.index') }}" class="btn-secondary">Kembali</a>
                        <button type="submit" class="button-brand">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
