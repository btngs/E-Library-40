<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Form Buku</p>
            <h2 class="page-title">
                Tambah Buku
            </h2>
            <p class="page-subtitle">
                Isi semua data buku dengan lengkap.
            </p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Tambah Buku Baru</h3>
                    <p class="form-shell-copy">
                        Lengkapi informasi buku agar data koleksi tersimpan dengan rapi.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.buku.store') }}" class="form-shell-body" enctype="multipart/form-data">
                    @csrf

                    @include('buku.partials.form')

                    <div class="form-actions">
                        <a href="{{ route('admin.buku.index') }}" class="btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="button-brand">
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
