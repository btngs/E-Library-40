<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Manajemen Anggota</p>
            <h2 class="page-title">Tambah Anggota</h2>
            <p class="page-subtitle">Buat akun baru dengan role siswa.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Tambah Anggota Baru</h3>
                    <p class="form-shell-copy">Lengkapi data akun anggota.</p>
                </div>

                <form method="POST" action="{{ route('admin.anggota.store') }}" class="form-shell-body">
                    @csrf

                    <div>
                        <label class="form-label" for="name">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-input">
                        @error('name') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input">
                        @error('email') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label" for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-input">
                        @error('password') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.anggota.index') }}" class="btn-secondary">Kembali</a>
                        <button type="submit" class="button-brand">Simpan Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
