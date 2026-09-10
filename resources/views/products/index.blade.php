@extends('layouts.app')
@section('title', 'Manajemen Produk')

@section('main')
<div>

    {{-- Top Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data inventaris, harga, stok, dan kategori produk Anda.</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Produk Baru
            </a>
        </div>
    </div>

    {{-- 4 Stats Cards (1 Row on Desktop) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total Produk --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 bg-blue-50 text-blue-600 rounded-lg p-3 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Total Produk</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($stats['total']) }}</p>
            </div>
        </div>

        {{-- Produk Aktif --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 bg-green-50 text-green-600 rounded-lg p-3 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Produk Aktif</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($stats['active']) }}</p>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 bg-amber-50 text-amber-600 rounded-lg p-3 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Stok Menipis (&le; 5)</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($stats['low_stock']) }}</p>
            </div>
        </div>

        {{-- Non-Aktif --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 bg-gray-100 text-gray-500 rounded-lg p-3 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Non-Aktif</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($stats['inactive']) }}</p>
            </div>
        </div>
    </div>

    {{-- Search & Filter Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
        <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
            {{-- Top Row: Search Input --}}
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama atau kode produk..."
                       class="w-full pl-11 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50/50 focus:bg-white text-gray-900 placeholder-gray-400 transition">
            </div>

            {{-- Bottom Row: Categories, Status, Filter and Reset Buttons --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1">
                    {{-- Kategori --}}
                    <div class="w-full sm:w-56">
                        <select name="category" class="w-full py-2 px-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-700">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="w-full sm:w-44">
                        <select name="status" class="w-full py-2 px-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-700">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="w-full sm:w-auto px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                        Terapkan Filter
                    </button>
                    @if(request('search') || request('category') || request('status'))
                        <a href="{{ route('products.index') }}"
                           class="w-full sm:w-auto px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition text-center">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- Products Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/75 transition-colors">
                        {{-- Code --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded font-mono text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $product->code }}
                            </span>
                        </td>

                        {{-- Name & Description --}}
                        <td class="px-6 py-4">
                            <a href="{{ route('products.show', $product) }}" class="font-semibold text-sm text-gray-900 hover:text-blue-600 transition block">
                                {{ $product->name }}
                            </a>
                            @if($product->description)
                                <p class="text-xs text-gray-500 mt-0.5 truncate max-w-xs sm:max-w-md">
                                    {{ Str::limit($product->description, 60) }}
                                </p>
                            @endif
                        </td>

                        {{-- Category --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $product->category }}
                            </span>
                        </td>

                        {{-- Price --}}
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-gray-900">
                            {{ $product->formatted_price }}
                        </td>

                        {{-- Stock --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            @if($product->stock == 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Habis (0)
                                </span>
                            @elseif($product->stock <= 5)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                    Sisa {{ $product->stock }}
                                </span>
                            @else
                                <span class="font-medium text-gray-800">{{ $product->stock }} unit</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($product->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-gray-400 rounded-full"></span>
                                    Non-Aktif
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-1.5">
                                {{-- View Detail --}}
                                <a href="{{ route('products.show', $product) }}"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                   title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('products.edit', $product) }}"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition"
                                   title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                {{-- Delete Button --}}
                                <button type="button"
                                        onclick="openDeleteModal('{{ route('products.destroy', $product) }}', '{{ addslashes($product->name) }}', '{{ $product->code }}')"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-red-600 hover:bg-red-50 transition"
                                        title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900">Belum ada produk ditemukan</h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-sm">
                                    @if(request('search') || request('category') || request('status'))
                                        Tidak ada produk yang cocok dengan kriteria pencarian atau filter Anda.
                                    @else
                                        Mulai tambahkan produk baru ke dalam inventaris katalog sistem Anda.
                                    @endif
                                </p>
                                <div class="mt-4 flex items-center space-x-3">
                                    @if(request('search') || request('category') || request('status'))
                                        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                                            Reset Filter
                                        </a>
                                    @endif
                                    <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                        + Tambah Produk
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>

{{-- Delete Confirmation Modal Dialog --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
    {{-- Backdrop Overlay (Semi-transparent dark backdrop) --}}
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" onclick="closeDeleteModal()" aria-hidden="true"></div>

    {{-- Modal Dialog Card (Elevated above backdrop with relative z-10) --}}
    <div class="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all my-8 animate-in fade-in zoom-in-95 duration-150">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900" id="deleteModalTitle">
                            Hapus Produk
                        </h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                            Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName" class="text-gray-900 font-semibold"></strong> (<span id="deleteProductCode" class="font-mono text-gray-700"></span>)?
                        </p>
                        <p class="text-xs text-red-600 font-medium mt-2">
                            Tindakan ini tidak dapat dibatalkan dan data akan dihapus permanen.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-gray-100">
                <button type="button"
                        id="cancelDeleteBtn"
                        onclick="closeDeleteModal()"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    Batal
                </button>
                <button type="submit"
                        id="confirmDeleteBtn"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-sm font-semibold text-white shadow-xs focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition inline-flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Ya, Hapus Produk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl, productName, productCode) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameEl = document.getElementById('deleteProductName');
        const codeEl = document.getElementById('deleteProductCode');
        
        if (form) form.action = actionUrl;
        if (nameEl) nameEl.textContent = productName;
        if (codeEl) codeEl.textContent = productCode;
        
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection
