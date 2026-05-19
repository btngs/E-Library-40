<x-guest-layout>
    <div class="mb-10">
        <p class="page-eyebrow mb-2">Selamat Datang Kembali</p>
        <h2 class="page-title">Masuk ke Akun</h2>
        <p class="page-subtitle mt-2">Silakan masukkan email dan kata sandi Anda untuk melanjutkan ke dashboard E-Library.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="form-label mb-0">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-bento-accent hover:underline transition" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>
            <input id="password" class="form-input"
                            type="password"
                            name="password"
                            required placeholder="••••••••"
                            autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-bento-accent focus:ring-bento-accent transition" name="remember">
            <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer">Ingat perangkat ini</label>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-primary w-full py-4 text-base">
                Masuk ke Dashboard
            </button>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-slate-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-slate-900 hover:text-bento-accent transition underline underline-offset-4">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
