@extends('layouts.base')

@section('content')
<div class="min-h-screen flex flex-col bg-gray-100">
    {{-- Navbar --}}
    <nav class="bg-white border-b border-slate-200/80 shadow-[0_1px_3px_0_rgba(0,0,0,0.02)] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Brand & Nav Links --}}
                <div class="flex items-center space-x-6 sm:space-x-8">
                    {{-- Brand / Logo --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5 group">
                        <span class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center text-xs font-black shadow-xs tracking-tight group-hover:bg-blue-700 transition">
                            LT
                        </span>
                        <span class="text-lg font-bold text-slate-900 tracking-tight group-hover:text-blue-600 transition">
                            {{ config('app.name', 'Last Test') }}
                        </span>
                    </a>

                    {{-- Desktop Menu Links --}}
                    <div class="hidden sm:flex sm:items-center space-x-1.5">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-3.5 py-1.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-blue-50/80 text-blue-600 font-semibold border border-blue-100/60' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 mr-1.5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center px-3.5 py-1.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('products.*') ? 'bg-blue-50/80 text-blue-600 font-semibold border border-blue-100/60' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 mr-1.5 {{ request()->routeIs('products.*') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Manajemen Produk
                        </a>
                    </div>
                </div>

                {{-- User Info & Logout (Desktop) --}}
                <div class="hidden sm:flex sm:items-center space-x-3">
                    {{-- User Badge / Name --}}
                    <div class="flex items-center space-x-2 px-3 py-1 rounded-lg bg-slate-50 border border-slate-200/60">
                        <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold uppercase">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </span>
                        <span class="text-sm font-medium text-slate-700">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    {{-- Logout Form --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-100 border border-slate-200/80 rounded-lg transition-colors shadow-2xs cursor-pointer"
                                title="Logout dari sistem">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

                {{-- Mobile Hamburger Button --}}
                <div class="flex items-center sm:hidden">
                    <button type="button"
                            id="mobileMenuToggle"
                            onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                            class="p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition"
                            aria-label="Toggle menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu Dropdown --}}
        <div id="mobileMenu" class="hidden sm:hidden border-t border-slate-200/80 bg-white px-4 pt-3 pb-4 space-y-2 shadow-sm">
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 mr-2 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 mr-2 {{ request()->routeIs('products.*') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Manajemen Produk
                </a>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold uppercase">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </span>
                    <span class="text-sm font-medium text-slate-700">
                        {{ auth()->user()->name }}
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center space-x-1 px-3 py-1 text-xs font-medium text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Page Header --}}
    @hasSection('header')
    <header class="bg-white border-b border-slate-200/80 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900">
                @yield('header')
            </h2>
        </div>
    </header>
    @endif

    {{-- Flash Messages --}}
    @if (session('success'))
    <div class="max-w-7xl mx-auto w-full mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="max-w-7xl mx-auto w-full mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('main')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
</div>
@endsection
