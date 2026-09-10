@extends('layouts.app')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('main')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Card: Total Users --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    {{-- Card: Registered Today --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Daftar Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900">{{ $todayUsers }}</p>
            </div>
        </div>
    </div>

    {{-- Card: App Status --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-amber-100 rounded-lg p-3">
                <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">App Environment</p>
                <p class="text-2xl font-bold text-gray-900">{{ ucfirst(app()->environment()) }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Recent Users Table --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">User Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($recentUsers as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-indigo-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada user terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- System Info --}}
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Sistem</h3>
        <dl class="space-y-3">
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Laravel</dt>
                <dd class="text-sm font-medium text-gray-900">v{{ app()->version() }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">PHP</dt>
                <dd class="text-sm font-medium text-gray-900">v{{ PHP_VERSION }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Database</dt>
                <dd class="text-sm font-medium text-gray-900">{{ config('database.default') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Cache</dt>
                <dd class="text-sm font-medium text-gray-900">{{ config('cache.default') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-sm text-gray-500">Session</dt>
                <dd class="text-sm font-medium text-gray-900">{{ config('session.driver') }}</dd>
            </div>
        </dl>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Panduan Tim</h3>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start">
                <span class="text-indigo-500 mr-2 mt-0.5">1.</span>
                Clone repo lalu jalankan <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">make setup</code>
            </li>
            <li class="flex items-start">
                <span class="text-indigo-500 mr-2 mt-0.5">2.</span>
                Buat branch baru: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">git checkout -b fitur/nama-fitur</code>
            </li>
            <li class="flex items-start">
                <span class="text-indigo-500 mr-2 mt-0.5">3.</span>
                Commit perubahan: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">git add . && git commit -m "pesan"</code>
            </li>
            <li class="flex items-start">
                <span class="text-indigo-500 mr-2 mt-0.5">4.</span>
                Push branch: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">git push origin fitur/nama-fitur</code>
            </li>
            <li class="flex items-start">
                <span class="text-indigo-500 mr-2 mt-0.5">5.</span>
                Buka Pull Request di GitHub/GitLab
            </li>
        </ul>
    </div>
</div>
@endsection
