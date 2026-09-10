@extends('layouts.base')

@section('content')
<div class="min-h-screen flex flex-col lg:flex-row bg-slate-50 antialiased">
    {{-- Left Showcase Panel (Visible on Desktop / Large Screens) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 text-white flex-col justify-between p-12 relative overflow-hidden border-r border-slate-800">
        {{-- Subtle radial gradient glows --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Top Brand --}}
        <div class="relative z-10 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ffffff;">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </div>
            <div>
                <span class="text-lg font-bold text-white tracking-tight block leading-tight">{{ config('app.name') }}</span>
                <span class="text-xs font-medium text-slate-400">Portal Manajemen Inventori</span>
            </div>
        </div>

        {{-- Center Content / Value Proposition --}}
        <div class="relative z-10 my-auto max-w-lg">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 mb-6">
                Sistem Terpadu &bull; Versi 1.0
            </span>
            <h1 class="text-3xl xl:text-4xl font-extrabold text-white tracking-tight leading-tight mb-4">
                Kelola Produk dan Inventori dengan Efisien.
            </h1>
            <p class="text-slate-400 text-sm xl:text-base leading-relaxed mb-8">
                Platform terpercaya untuk memantau stok secara realtime, pencarian katalog cerdas, dan pengelolaan data yang terstruktur.
            </p>

            <div class="space-y-3.5 text-sm text-slate-300">
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Pencarian dan katalog produk cepat dengan kode unik</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Peringatan otomatis untuk inventori yang perlu restok</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Autentikasi aman dan antarmuka responsif</span>
                </div>
            </div>
        </div>

        {{-- Bottom Footer Note --}}
        <div class="relative z-10 text-xs text-slate-500 flex items-center justify-between">
            <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
            <span class="inline-flex items-center text-emerald-400 font-medium">
                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse mr-1.5"></span>
                Sistem Online
            </span>
        </div>
    </div>

    {{-- Right Form Area (Full width on mobile, 50% on Desktop) --}}
    <div class="flex-1 flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-16 xl:px-24 bg-white min-h-screen lg:min-h-0">
        {{-- Mobile Header Logo (visible only on mobile/tablet screens) --}}
        <div class="lg:hidden flex items-center space-x-3 mb-8 justify-center">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-md shadow-indigo-500/25 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ffffff;">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </div>
            <div>
                <span class="text-lg font-bold text-slate-900 tracking-tight block leading-tight">{{ config('app.name') }}</span>
                <span class="text-xs text-slate-400">Portal Manajemen Inventori</span>
            </div>
        </div>

        <div class="w-full max-w-md mx-auto">
            @yield('form')
        </div>
    </div>
</div>
@endsection
