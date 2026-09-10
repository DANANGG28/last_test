@extends('layouts.guest')
@section('title', 'Login')

@section('form')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Login</h2>

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input id="password" type="password" name="password" required
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('password') border-red-500 @enderror">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input id="remember" type="checkbox" name="remember"
               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
    </div>

    <button type="submit"
            class="w-full bg-indigo-600 text-white py-2.5 px-4 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
        Login
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-600">
    Belum punya akun?
    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Daftar di sini</a>
</p>
@endsection
