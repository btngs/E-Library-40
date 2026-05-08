<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Pengaturan Akun</p>
            <h2 class="page-title leading-tight">{{ __('Profil Admin') }}</h2>
            <p class="page-subtitle">
                Kelola data akun, ubah kata sandi, dan akses tindakan penting dari satu halaman yang ringkas.
            </p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="page-wrapper space-y-6">
            <div class="rounded-3xl border border-sky-100 bg-gradient-to-r from-sky-50 to-white p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-600">Ringkasan</p>
                <h3 class="mt-2 text-2xl font-bold text-slate-950">Kelola akun Anda dengan lebih jelas</h3>
                <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-600">
                    Perbarui nama dan email di bagian informasi akun, gunakan panel kedua untuk mengganti kata sandi,
                    dan pakai zona merah hanya jika benar-benar ingin menghapus akun.
                </p>
            </div>

            <div class="grid gap-6 xl:grid-cols-2">
                <div class="form-shell">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="form-shell">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="table-card border border-rose-200">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
