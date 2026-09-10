@extends('layouts.guest')
@section('title', 'Masuk ke Akun')

@section('form')
<div>
    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
            Selamat Datang
        </h2>
        <p class="text-sm text-slate-500 mt-2">
            Silakan masukkan kredensial akun Anda untuk mengakses sistem.
        </p>
    </div>

    {{-- Error Alert (if any general error) --}}
    @if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2.5 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">Periksa kembali data yang Anda masukkan.</span>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email Field --}}
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                Alamat Email <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       placeholder="nama@perusahaan.com"
                       class="w-full pl-11 pr-4 py-2.5 bg-slate-50/50 border @error('email') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
            </div>
            @error('email')
                <p class="text-rose-600 text-xs font-medium mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700">
                    Kata Sandi <span class="text-rose-500">*</span>
                </label>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       class="w-full pl-11 pr-11 py-2.5 bg-slate-50/50 border @error('password') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                {{-- Toggle Password Button --}}
                <button type="button"
                        onclick="togglePasswordVisibility('password', this)"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-rose-600 text-xs font-medium mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between pt-1">
            <label for="remember" class="flex items-center cursor-pointer">
                <input id="remember"
                       type="checkbox"
                       name="remember"
                       class="h-4 w-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                <span class="ml-2.5 text-xs font-medium text-slate-600">Ingat sesi saya</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.99] text-white py-2.5 px-4 rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all duration-150 flex items-center justify-center">
            <span>Masuk ke Sistem</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </form>

    {{-- Quick Demo Account helper --}}
    <div class="mt-6 p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-600 flex items-center justify-between">
        <div>
            <span class="font-semibold text-slate-700">Akun Pengujian (Seeder):</span>
            <p class="text-slate-500 font-mono text-[11px] mt-0.5">admin@example.com &bull; password</p>
        </div>
        <button type="button"
                onclick="fillDemoCredentials()"
                class="text-indigo-600 hover:text-indigo-800 font-semibold px-2.5 py-1 bg-white border border-slate-200 rounded-lg shadow-xs hover:bg-indigo-50 transition-colors">
            Gunakan
        </button>
    </div>

    {{-- Register link --}}
    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold ml-1">
                Daftar akun baru &rarr;
            </a>
        </p>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            button.classList.add('text-indigo-600');
        } else {
            input.type = 'password';
            button.classList.remove('text-indigo-600');
        }
    }

    function fillDemoCredentials() {
        document.getElementById('email').value = 'admin@example.com';
        document.getElementById('password').value = 'password';
    }
</script>
@endsection
