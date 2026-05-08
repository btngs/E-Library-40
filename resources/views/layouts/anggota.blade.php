<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <div class="member-shell">
            <nav class="member-navbar" x-data="{ profileOpen: false, navOpen: false }">
                <div class="member-navbar-inner !flex-row !justify-between !items-center">
                    <a href="{{ route('anggota.dashboard') }}" class="member-brand">
                        <div class="member-brand-logo">
                            <x-application-logo class="h-10 w-10 object-contain" />
                        </div>
                        <div>
                            <p class="member-brand-label">E-Library</p>
                            <p class="member-brand-title">SMKN 40 JAKARTA</p>
                        </div>
                    </a>

                    <div class="flex items-center gap-4">
                        <div class="hidden md:flex member-navbar-links">
                            <a href="{{ route('anggota.dashboard') }}" class="member-nav-link {{ request()->routeIs('anggota.dashboard') ? 'is-active' : '' }}">
                                Halaman Utama
                            </a>
                            <a href="{{ route('anggota.peminjaman.saya') }}" class="member-nav-link {{ request()->routeIs('anggota.peminjaman.saya*') ? 'is-active' : '' }}">
                                Peminjaman Saya
                            </a>
                            <a href="{{ route('anggota.peminjaman.index') }}" class="member-nav-link {{ request()->routeIs('anggota.peminjaman.index', 'anggota.buku.show') ? 'is-active' : '' }}">
                                Koleksi Buku
                            </a>
                        </div>

                        <!-- Desktop Profile & Fine -->
                        <div class="hidden md:flex member-navbar-actions">
                            <div class="member-fine-badge">
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">Denda</span>
                                <span class="text-sm font-bold text-slate-900">Rp{{ number_format($totalDendaAktif, 0, ',', '.') }}</span>
                            </div>

                            <div class="relative" x-data="{ desktopProfileOpen: false }">
                                <button @click="desktopProfileOpen = !desktopProfileOpen" class="member-profile-trigger">
                                    <span class="member-profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    <span class="hidden text-left lg:block">
                                        <span class="block text-sm font-bold text-slate-900">{{ Auth::user()->name }}</span>
                                        <span class="block text-xs text-slate-500">Anggota</span>
                                    </span>
                                </button>

                                <div
                                    x-show="desktopProfileOpen"
                                    x-cloak
                                    @click.outside="desktopProfileOpen = false"
                                    class="member-profile-menu"
                                >
                                    <a href="{{ route('anggota.profile.show') }}" class="member-profile-menu-link">
                                        Informasi Pengguna
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="member-profile-menu-link w-full text-left text-rose-600">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <nav class="bottom-nav" x-data="{ accountMenuOpen: false }">
                <a href="{{ route('anggota.dashboard') }}" class="bottom-nav-link {{ request()->routeIs('anggota.dashboard') ? 'is-active' : '' }}">
                    <svg class="bottom-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="bottom-nav-label">Beranda</span>
                </a>
                <a href="{{ route('anggota.peminjaman.saya') }}" class="bottom-nav-link {{ request()->routeIs('anggota.peminjaman.saya*') ? 'is-active' : '' }}">
                    <svg class="bottom-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="bottom-nav-label">Pinjaman</span>
                </a>
                <a href="{{ route('anggota.peminjaman.index') }}" class="bottom-nav-link {{ request()->routeIs('anggota.peminjaman.index', 'anggota.buku.show') ? 'is-active' : '' }}">
                    <svg class="bottom-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="bottom-nav-label">Koleksi</span>
                </a>
                
                <a href="{{ route('anggota.profile.show') }}" class="bottom-nav-link {{ request()->routeIs('anggota.profile.show') ? 'is-active' : '' }}">
                    <div class="flex h-6 w-6 items-center justify-center rounded-full {{ request()->routeIs('anggota.profile.show') ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-500' }} text-[10px] font-bold transition-colors">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="bottom-nav-label">Akun</span>
                </a>
            </nav>

            <main class="member-main">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
