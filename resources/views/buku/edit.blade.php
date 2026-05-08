<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow-warm">Form Buku</p>
            <h2 class="page-title">
                Edit Buku
            </h2>
            <p class="page-subtitle">
                Perbarui data buku yang dipilih.
            </p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="form-page-wrapper">
            <div class="form-shell">
                <div class="form-shell-header">
                    <h3 class="form-shell-title">Perbarui Data Buku</h3>
                    <p class="form-shell-copy">
                        Pastikan perubahan data buku sudah sesuai sebelum disimpan.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.buku.update', $buku) }}" class="form-shell-body" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('buku.partials.form')

                    <div class="form-actions">
                        <a href="{{ route('admin.buku.index') }}" class="btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="button-brand">
                            Update Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
