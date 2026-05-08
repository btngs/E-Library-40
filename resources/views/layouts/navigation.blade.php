<div x-data="{ open: false }" class="flex flex-col h-full bg-slate-950 text-white">
    <!-- Brand/Logo Area -->
    <div class="p-6">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 p-2 ring-1 ring-white/15">
                <x-application-logo class="h-full w-full object-contain" />
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-sky-400">E-Library</span>
                <span class="text-sm font-bold text-white">SMKN 40 Jakarta</span>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 px-4 space-y-1">
        <div class="nav-header">
            Menu Utama
        </div>

        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-sm font-medium">{{ __('Dashboard') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.buku.index')" :active="request()->routeIs('admin.buku.*')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-sm font-medium">{{ __('Data Buku') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.75a6 6 0 00-12 0M12 12a4.5 4.5 0 100-9 4.5 4.5 0 000 9zm6 6.75c0-2.485-2.686-4.5-6-4.5s-6 2.015-6 4.5" />
            </svg>
            <span class="text-sm font-medium">{{ __('Manajemen Anggota') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66a2.25 2.25 0 00-1.592-.659z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            <span class="text-sm font-medium">{{ __('Data Kategori') }}</span>
        </x-nav-link>

        <div class="nav-header">
            Menu Transaksi
        </div>
        <x-nav-link :href="route('admin.peminjaman.index')" :active="request()->routeIs('admin.peminjaman.*')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h13.5M8.25 12h13.5m-13.5 5.25h13.5M4.5 6.75h.008v.008H4.5V6.75zm0 5.25h.008v.008H4.5V12zm0 5.25h.008v.008H4.5v-.008z" />
            </svg>
            <span class="text-sm font-medium">{{ __('Kelola Pinjam') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('admin.denda.index')" :active="request()->routeIs('admin.denda.*')" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ __('Kelola Denda') }}</span>
        </x-nav-link>
    </div>

    <!-- User Section -->
    <div class="p-4 mt-auto border-t border-white/5 bg-white/5">
        <div class="px-2 mb-3">
            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
        </div>

        <div class="space-y-1">
            <x-nav-link :href="route('admin.profile.edit')" :active="request()->routeIs('admin.profile.edit')" class="flex items-center px-3 py-2 rounded-lg text-xs transition-all duration-200">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                {{ __('Profile') }}
            </x-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center px-3 py-2 rounded-lg text-xs text-rose-400 hover:bg-rose-500/10 transition-all duration-200">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>
