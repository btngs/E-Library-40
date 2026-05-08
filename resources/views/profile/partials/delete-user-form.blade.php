<section class="space-y-6">
    <div class="rounded-3xl bg-rose-50 px-6 py-6">
        <h2 class="text-xl font-bold text-rose-900">{{ __('Hapus Akun') }}</h2>
        <p class="mt-2 max-w-3xl text-sm leading-7 text-rose-800">
            {{ __('Tindakan ini permanen. Setelah akun dihapus, data akses Anda tidak bisa dipulihkan lagi.') }}
        </p>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700"
    >{{ __('Hapus Akun Sekarang') }}</button>

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

                <button type="submit" class="ms-3 inline-flex items-center justify-center rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700">
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
