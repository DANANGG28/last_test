@extends('layouts.base')

@section('content')
<div class="min-h-screen bg-slate-50 antialiased">
    {{-- Mobile Sidebar Backdrop --}}
    <div id="sidebarBackdrop"
         onclick="toggleSidebar()"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-30 hidden lg:hidden transition-opacity duration-300 opacity-0"
         aria-hidden="true"></div>

    {{-- Fixed Sidebar (Stays fixed on screen, never scrolls away) --}}
    <aside id="mainSidebar"
           class="fixed inset-y-0 left-0 z-40 w-72 h-screen bg-white border-r border-slate-200 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none">
        
        {{-- Top Section: Brand & Navigation --}}
        <div class="flex flex-col flex-1 min-h-0 overflow-hidden">
            {{-- Brand / Logo (Fixed at the top of the sidebar) --}}
            <div class="h-16 px-6 flex items-center justify-between border-b border-slate-100 flex-shrink-0 bg-white">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    {{-- Logo Icon (Guaranteed visible with explicit SVG dimensions and colors) --}}
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-600 flex items-center justify-center shadow-md shadow-indigo-500/25 group-hover:scale-105 transition-all duration-200 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#ffffff"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             style="color: #ffffff;">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-base font-bold text-slate-900 tracking-tight block leading-tight truncate">
                            {{ config('app.name') }}
                        </span>
                        <span class="text-[11px] font-medium text-slate-400 uppercase tracking-wider block truncate">
                            Management Portal
                        </span>
                    </div>
                </a>

                {{-- Close Button for Mobile Drawer --}}
                <button type="button"
                        onclick="toggleSidebar()"
                        class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg lg:hidden transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Inner Scrollable Navigation (Only this list scrolls if menu exceeds height) --}}
            <div class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">
                {{-- Group: Menu Utama --}}
                <div>
                    <div class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                        Menu Utama
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </nav>
                </div>

                {{-- Group: Data & Inventori --}}
                <div>
                    <div class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                        Data & Inventori
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ route('products.index') }}"
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center min-w-0">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ request()->routeIs('products.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span class="truncate">Kelola Produk</span>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold ml-2 {{ request()->routeIs('products.*') ? 'bg-indigo-200/60 text-indigo-800' : 'bg-slate-100 text-slate-600' }}">
                                CRUD
                            </span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Bottom Section: User Profile Card (Fixed at the bottom of the sidebar) --}}
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex-shrink-0">
            <div class="flex items-center justify-between p-2.5 rounded-xl bg-white border border-slate-200/80 shadow-xs">
                <div class="flex items-center min-w-0 mr-2">
                    {{-- Admin Profile Image (from resources/image/logo-admin.jpg) --}}
                    <div class="relative flex-shrink-0">
                        <img src="{{ asset('image/logo-admin.jpg') }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-10 h-10 rounded-xl object-cover border border-slate-200/80 shadow-xs bg-slate-100">
                        <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="ml-3 min-w-0">
                        <div class="flex items-center space-x-1">
                            <p class="text-xs font-bold text-slate-800 truncate" title="{{ auth()->user()->name }}">
                                {{ auth()->user()->name }}
                            </p>
                        </div>
                        <p class="text-[11px] text-slate-400 truncate" title="{{ auth()->user()->email }}">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                {{-- Logout Button --}}
                <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                    @csrf
                    <button type="submit"
                            title="Keluar / Logout"
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="18"
                             height="18"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main App Area (Pushed to the right on desktop by lg:pl-72 so it never gets covered) --}}
    <div class="lg:pl-72 flex flex-col min-h-screen min-w-0">
        {{-- Sticky Topbar --}}
        <header class="h-16 bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-20 px-4 sm:px-6 lg:px-8 flex items-center justify-between shadow-xs">
            <div class="flex items-center space-x-3">
                {{-- Hamburger Toggle Button for Mobile --}}
                <button type="button"
                        onclick="toggleSidebar()"
                        class="p-2 -ml-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg lg:hidden transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Page Header Title --}}
                <div>
                    @hasSection('header')
                        <h1 class="text-lg sm:text-xl font-bold text-slate-800 leading-tight">
                            @yield('header')
                        </h1>
                    @else
                        <h1 class="text-lg sm:text-xl font-bold text-slate-800 leading-tight">
                            {{ config('app.name') }}
                        </h1>
                    @endif
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="hidden sm:flex items-center px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse mr-1.5"></span>
                    Sistem Aktif
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-xs font-medium text-slate-700">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-slate-400">Online</p>
                </div>
            </div>
        </header>

        {{-- Flash Alerts --}}
        @if (session('success'))
        <div class="max-w-7xl w-full mx-auto mt-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-xs">
                <svg class="w-5 h-5 mr-3 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="max-w-7xl w-full mx-auto mt-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl shadow-xs">
                <svg class="w-5 h-5 mr-3 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        </div>
        @endif

        {{-- Main Page Content (This container scrolls smoothly when the user scrolls the page) --}}
        <main class="flex-1 py-8">
            <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
                @yield('main')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-slate-200 py-4 px-4 sm:px-6 lg:px-8 mt-auto">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                <span>&copy; {{ date('Y') }} <strong class="text-slate-700 font-semibold">{{ config('app.name') }}</strong>. Hak cipta dilindungi.</span>
                <span class="text-slate-400">Laravel v{{ Illuminate\Foundation\Application::VERSION }} &bull; PHP v{{ PHP_VERSION }}</span>
            </div>
        </footer>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mainSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        const isClosed = sidebar.classList.contains('-translate-x-full');

        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
            }, 10);
        } else {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);
        }
    }
</script>
@endsection
