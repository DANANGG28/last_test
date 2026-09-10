@extends('layouts.base')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-6">
        <div class="text-center">
            <a href="/" class="inline-flex items-center space-x-2 text-2xl font-bold text-blue-600 tracking-tight">
                <span class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-base font-black shadow-sm">
                    LT
                </span>
                <span class="text-slate-900">{{ config('app.name') }}</span>
            </a>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1.5">Admin Management System</p>
        </div>
        <div class="bg-white shadow-sm border border-slate-200/80 rounded-2xl px-7 py-8">
            @yield('form')
        </div>
    </div>
</div>
@endsection
