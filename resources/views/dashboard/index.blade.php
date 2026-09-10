@extends('layouts.app')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('main')
<div class="space-y-6">
    {{-- Greeting Banner (1 Solid Color, No Shadows, Clean & Simple) --}}
    <div class="bg-indigo-600 rounded-xl p-6 sm:p-7 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-indigo-200 mb-1">
                    Portal Manajemen &bull; {{ config('app.name') }}
                </p>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>
                <p class="mt-1 text-xs sm:text-sm text-indigo-100 max-w-xl">
                    Pantau statistik inventori produk dan kelola data aplikasi Anda secara terstruktur.
                </p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-white hover:bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                     Tambah Produk
                </a>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-700 hover:bg-indigo-800 text-white text-xs font-semibold rounded-lg border border-indigo-500 transition-colors">
                    Kelola Katalog 
                </a>
            </div>
        </div>
    </div>

    {{-- 4 Stat Cards: Products & Users Overview (Icon Sized Proportionally & Harmoniously) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        {{-- Card 1: Total Produk --}}
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs hover:shadow-sm transition-shadow">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Produk</p>
                    <div class="flex items-baseline space-x-1.5 mt-1.5">
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900">{{ number_format($totalProducts, 0, ',', '.') }}</p>
                        <span class="text-xs font-medium text-slate-400">item</span>
                    </div>
                    <p class="text-xs text-indigo-600 font-medium mt-1">
                        {{ $activeProducts }} produk aktif dijual
                    </p>
                </div>
                {{-- Compact icon badge --}}
                <div class="w-9 h-9 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <div class="mt-3.5 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold inline-flex items-center">
                    Lihat Semua &rarr;
                </a>
                <span class="text-slate-400 text-[11px]">Katalog</span>
            </div>
        </div>

        {{-- Card 2: Perlu Restok (Stok <= 5) --}}
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs hover:shadow-sm transition-shadow">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Perlu Restok</p>
                    <div class="flex items-baseline space-x-1.5 mt-1.5">
                        <p class="text-2xl sm:text-3xl font-bold {{ $lowStockProducts > 0 ? 'text-amber-600' : 'text-slate-900' }}">
                            {{ number_format($lowStockProducts, 0, ',', '.') }}
                        </p>
                        <span class="text-xs font-medium text-slate-400">item</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium mt-1">
                        Stok minim (&le; 5 unit)
                    </p>
                </div>
                {{-- Compact icon badge --}}
                <div class="w-9 h-9 rounded-lg bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3.5 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('products.index') }}" class="text-amber-600 hover:text-amber-800 font-semibold inline-flex items-center">
                    Cek Stok &rarr;
                </a>
                <span class="text-slate-400 text-[11px]">Alert</span>
            </div>
        </div>

        {{-- Card 3: Total Pengguna --}}
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs hover:shadow-sm transition-shadow">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Pengguna</p>
                    <div class="flex items-baseline space-x-1.5 mt-1.5">
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900">{{ number_format($totalUsers, 0, ',', '.') }}</p>
                        <span class="text-xs font-medium text-slate-400">user</span>
                    </div>
                    <p class="text-xs text-emerald-600 font-medium mt-1">
                        Pengguna terdaftar
                    </p>
                </div>
                {{-- Compact icon badge --}}
                <div class="w-9 h-9 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3.5 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-emerald-600 font-semibold">Tersinkron</span>
                <span class="text-slate-400 text-[11px]">Database</span>
            </div>
        </div>

        {{-- Card 4: Terdaftar Hari Ini --}}
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs hover:shadow-sm transition-shadow">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Daftar Hari Ini</p>
                    <div class="flex items-baseline space-x-1.5 mt-1.5">
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900">{{ number_format($todayUsers, 0, ',', '.') }}</p>
                        <span class="text-xs font-medium text-slate-400">user</span>
                    </div>
                    <p class="text-xs text-sky-600 font-medium mt-1">
                        Pendaftar baru hari ini
                    </p>
                </div>
                {{-- Compact icon badge --}}
                <div class="w-9 h-9 rounded-lg bg-sky-50 border border-sky-100 text-sky-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3.5 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 text-[11px]">{{ date('d M Y') }}</span>
                <span class="text-sky-600 font-semibold">Hari Ini</span>
            </div>
        </div>
    </div>

    {{-- Bottom Grid: User Terbaru & Info Sistem --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Users --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-900">User Terdaftar Terbaru</h3>
                <span class="text-xs font-semibold text-slate-400">{{ $totalUsers }} Total</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/75">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentUsers as $user)
                        <tr class="hover:bg-slate-50/75 transition-colors">
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="ml-2.5 text-xs font-semibold text-slate-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-xs text-slate-500">{{ $user->email }}</td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-xs text-slate-400">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-6 text-center text-xs text-slate-400">Belum ada data user.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Info Sistem & Quick Status --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-900 mb-4">Informasi Sistem & Server</h3>
                <dl class="space-y-3 text-xs">
                    <div class="flex justify-between py-1.5 border-b border-slate-100">
                        <dt class="text-slate-500 font-medium">Framework</dt>
                        <dd class="font-semibold text-slate-900">Laravel v{{ app()->version() }}</dd>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-100">
                        <dt class="text-slate-500 font-medium">PHP Engine</dt>
                        <dd class="font-semibold text-slate-900">PHP v{{ PHP_VERSION }}</dd>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-100">
                        <dt class="text-slate-500 font-medium">Database Driver</dt>
                        <dd class="font-semibold text-slate-900 uppercase">{{ config('database.default') }}</dd>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-100">
                        <dt class="text-slate-500 font-medium">Cache & Session</dt>
                        <dd class="font-semibold text-slate-900 capitalize">{{ config('cache.default') }} / {{ config('session.driver') }}</dd>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <dt class="text-slate-500 font-medium">Status Aplikasi</dt>
                        <dd class="inline-flex items-center text-emerald-600 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            {{ ucfirst(app()->environment()) }} Mode
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                <span>Versi Portal: v1.0.0</span>
                <span class="font-mono text-[11px]">{{ date('Y-m-d H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
