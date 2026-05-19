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

            <div class="rounded-xl border border-rose-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-rose-600">Keamanan Akun</p>
                        <h3 class="mt-2 text-xl font-bold text-slate-950">Hapus Akun Permanen</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-600">
                            Tindakan ini bersifat permanen. Setelah akun dihapus, data akses Anda tidak bisa dipulihkan lagi.
                        </p>
                    </div>

                    <button
                        type="button"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="inline-flex items-center justify-center rounded-lg bg-rose-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-rose-700 shrink-0"
                    >
                        {{ __('Hapus Akun Sekarang') }}
                    </button>
                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('admin.profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-bold text-slate-950">{{ __('Konfirmasi Hapus Akun') }}</h2>

                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            {{ __('Masukkan password Anda untuk memastikan bahwa akun ini benar-benar ingin dihapus secara permanen.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Password') }}" />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-2 block w-full sm:w-3/4"
                                placeholder="{{ __('Password') }}"
                            />

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-secondary-button>

                            <button type="submit" class="ms-3 inline-flex items-center justify-center rounded-lg bg-rose-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-rose-700">
                                {{ __('Ya, Hapus Akun') }}
                            </button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Sesi Akun</p>
                    <h3 class="mt-2 text-xl font-bold text-slate-950">Keluar dari Aplikasi</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">
                        Gunakan tombol di bawah ini untuk mengakhiri sesi admin Anda saat ini pada perangkat ini.
                    </p>
                </div>

                <div class="mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-slate-100 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200"
                        >
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
