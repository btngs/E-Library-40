<x-guest-layout>
    <div class="mb-10">
        <p class="page-eyebrow mb-2">Pendaftaran Akun</p>
        <h2 class="page-title">Buat Akun Baru</h2>
        <p class="page-subtitle mt-2">Daftar sekarang untuk mulai mengelola koleksi buku dan peminjaman di E-Library.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap" autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" class="form-input"
                            type="password"
                            name="password"
                            required placeholder="Buat kata sandi minimal 8 karakter"
                            autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="form-input"
                            type="password"
                            name="password_confirmation" 
                            required placeholder="Ulangi kata sandi Anda"
                            autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-primary w-full py-4 text-base">
                Daftar Akun Baru
            </button>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-slate-900 hover:text-sky-600 transition underline underline-offset-4">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
