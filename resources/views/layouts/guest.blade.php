@extends('layouts.base')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-50">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-600">{{ config('app.name') }}</h1>
            <p class="text-gray-500 mt-1">Training Project</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl px-8 py-10">
            @yield('form')
        </div>
    </div>
</div>
@endsection
