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
<body class="font-sans antialiased text-slate-900" x-data="{ mobileMenuOpen: false }">
    <div class="flex min-h-screen bg-slate-50">

        <!-- Sidebar Desktop -->
        <aside class="hidden md:flex md:w-72 md:flex-col fixed inset-y-0 shadow-2xl z-50">
            @include('layouts.navigation')
        </aside>

        <!-- Sidebar Mobile -->
        <div 
            x-show="mobileMenuOpen" 
            class="fixed inset-0 z-50 md:hidden" 
            x-ref="dialog" 
            aria-modal="true"
        >
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"
            ></div>

            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed inset-y-0 left-0 flex w-full max-w-xs"
            >
                <div class="relative flex-1 flex flex-col">
                    <div class="absolute top-0 right-0 -mr-12 pt-4">
                        <button @click="mobileMenuOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @include('layouts.navigation')
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col md:pl-72">
            
            <!-- Mobile Topbar -->
            <div class="sticky top-0 z-40 md:hidden flex items-center justify-between bg-white px-4 py-3 border-b border-slate-200 shadow-sm">
                <div class="flex items-center gap-3">
                    <x-application-logo class="h-8 w-8 object-contain" />
                    <span class="font-bold text-slate-950">E-Library</span>
                </div>
                <button @click="mobileMenuOpen = true" class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            @isset($header)
                <header class="bg-white border-b border-slate-200">
                    <div class="px-6 py-8 md:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                <div class="py-8 px-6 md:px-8">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>
</body>
</html>
