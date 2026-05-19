<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="auth-shell">
            <div class="auth-panel">
                <div class="auth-aside">
                    <div class="auth-aside-overlay"></div>

                    <div class="relative">
                        <a href="{{ route('login') }}" class="auth-brand">
                            <span class="auth-brand-badge">
                                <x-application-logo class="h-12 w-12 rounded-full object-contain" />
                            </span>
                            <span class="auth-brand-copy">
                                <span class="auth-brand-label">E-Library</span>
                                <span class="auth-brand-title">SMK Negeri 40 Jakarta</span>
                            </span>
                        </a>
                    </div>

                    <div class="auth-aside-copy">
                        <div>
                            <p class="auth-aside-eyebrow">Perpustakaan Digital</p>
                            <h1 class="auth-aside-title">
                                Kelola buku sekolah dengan mudah dan efisien
                            </h1>
                            <p class="auth-aside-text">
                                Masuk ke dashboard untuk memantau data buku, stok, dan profil akun dalam satu tempat.
                            </p>
                        </div>

                        <div class="auth-info-card">
                            <p class="auth-info-text">Satu dashboard untuk koleksi buku, manajemen stok, dan pengaturan akun pengguna.</p>
                        </div>
                    </div>
                </div>

                <div class="auth-content">
                    <div class="auth-content-inner">
                        <div class="auth-mobile-brand">
                            <span class="auth-mobile-badge">
                                <x-application-logo class="h-10 w-10 rounded-full object-contain" />
                            </span>
                            <div>
                                <p class="auth-mobile-label">E-Library</p>
                                <p class="auth-mobile-title">SMK Negeri 40 Jakarta</p>
                            </div>
                        </div>

                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
