<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow-warm">Manajemen Anggota</p>
            <h2 class="page-title">Edit Anggota</h2>
            <p class="page-subtitle">Perbarui data akun anggota.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Edit Data Anggota</h3>
                    <p class="form-shell-copy">Password boleh dikosongkan jika tidak ingin diubah.</p>
                </div>

                <form method="POST" action="{{ route('admin.anggota.update', $anggota) }}" class="form-shell-body">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="form-label" for="name">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $anggota->name) }}" class="form-input">
                        @error('name') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $anggota->email) }}" class="form-input">
                        @error('email') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label" for="password">Password Baru</label>
                        <input id="password" name="password" type="password" class="form-input">
                        @error('password') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.anggota.index') }}" class="btn-secondary">Kembali</a>
                        <button type="submit" class="button-brand">Update Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
