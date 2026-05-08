<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Form Peminjaman</p>
            <h2 class="page-title">Tambah Peminjaman</h2>
            <p class="page-subtitle">Daftarkan peminjaman buku untuk siswa secara langsung.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Data Peminjaman</h3>
                    <p class="form-shell-copy">Pilih siswa dan buku yang akan dipinjam, serta tentukan batas waktu pengembalian.</p>
                </div>

                <form method="POST" action="{{ route('admin.peminjaman.store') }}" class="form-shell-body">
                    @csrf

                    <div>
                        <label for="user_id" class="form-label">Nama Siswa</label>
                        <select name="user_id" id="user_id" class="form-input @error('user_id') border-rose-500 @enderror" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}" {{ old('user_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} ({{ $s->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="buku_id" class="form-label">Judul Buku</label>
                        <select name="buku_id" id="buku_id" class="form-input @error('buku_id') border-rose-500 @enderror" required>
                            <option value="">Pilih Buku</option>
                            @foreach($buku as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }} - Stok: {{ $b->stok }}
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jatuh_tempo" class="form-label">Batas Kembali (Jatuh Tempo)</label>
                        <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-input @error('jatuh_tempo') border-rose-500 @enderror" value="{{ old('jatuh_tempo', now()->addDays(7)->format('Y-m-d')) }}" required>
                        @error('jatuh_tempo')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.peminjaman.index', ['tab' => 'pinjam']) }}" class="btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="button-brand">
                            Simpan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
