@extends('layouts.app')
@section('title', 'Detail Produk: ' . $product->name)
@section('header', 'Detail Produk')

@section('main')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Breadcrumb & Back button --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Produk
        </a>
        <div class="flex items-center space-x-2">
            <a href="{{ route('products.edit', $product) }}"
               class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Produk
            </a>
            <button type="button"
                    onclick="openDeleteModal('{{ route('products.destroy', $product) }}', '{{ addslashes($product->name) }}', '{{ $product->code }}')"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus
            </button>
        </div>
    </div>

    {{-- Main Product Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- Header Bar --}}
        <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50/50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2.5 py-0.5 rounded font-mono text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                            {{ $product->code }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $product->category }}
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold mt-2 text-gray-900">{{ $product->name }}</h1>
                </div>
                <div>
                    @if($product->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                            <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                            Aktif & Terpublikasi
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                            <span class="w-2 h-2 mr-1.5 bg-gray-400 rounded-full"></span>
                            Non-Aktif
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Detail Metric Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 border-b border-gray-200 bg-white">
            <div class="p-6 text-center">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Harga Jual</span>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $product->formatted_price }}</p>
            </div>
            <div class="p-6 text-center">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Stok Tersedia</span>
                <div class="mt-1">
                    @if($product->stock == 0)
                        <span class="text-2xl font-bold text-red-600">0 Unit (Habis)</span>
                    @elseif($product->stock <= 5)
                        <span class="text-2xl font-bold text-amber-600">{{ $product->stock }} Unit</span>
                        <p class="text-xs text-amber-600 mt-0.5 font-medium">Stok menipis</p>
                    @else
                        <span class="text-2xl font-bold text-gray-900">{{ $product->stock }} Unit</span>
                    @endif
                </div>
            </div>
            <div class="p-6 text-center">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Kategori</span>
                <p class="text-2xl font-bold text-blue-600 mt-1">{{ $product->category }}</p>
            </div>
        </div>

        {{-- Description & Metadata --}}
        <div class="p-6 sm:p-8 space-y-6">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-2">Deskripsi Produk</h3>
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-sm text-gray-700 leading-relaxed">
                    @if($product->description)
                        {!! nl2br(e($product->description)) !!}
                    @else
                        <p class="text-gray-400 italic">Tidak ada deskripsi rinci untuk produk ini.</p>
                    @endif
                </div>
            </div>

            {{-- Timestamps / Audit info --}}
            <div class="pt-6 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-gray-500">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Dibuat pada: <strong>{{ $product->created_at->format('d M Y, H:i') }}</strong></span>
                </div>
                <div class="flex items-center space-x-2 sm:justify-end">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Terakhir diperbarui: <strong>{{ $product->updated_at->format('d M Y, H:i') }}</strong></span>
                </div>
            </div>
        </div>
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
