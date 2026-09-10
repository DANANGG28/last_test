@extends('layouts.app')
@section('title', 'Detail Produk: ' . $product->name)
@section('header', 'Detail Produk')

@section('main')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Card Detail --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- Header Card --}}
        <div class="px-6 py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h3 class="text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                    @if ($product->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-green-600 rounded-full"></span>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-gray-400 rounded-full"></span>
                            Nonaktif
                        </span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mt-1">Kode: <span class="font-mono font-semibold text-gray-700">{{ $product->code }}</span></p>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('products.edit', $product) }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Produk
                </a>
                <button type="button"
                        onclick="openDeleteModal('{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ route('products.destroy', $product) }}')"
                        class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </div>
        </div>

        {{-- Info Grid --}}
        <div class="p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</dt>
                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ $product->category }}</dd>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</dt>
                    <dd class="mt-1 text-base font-semibold text-indigo-600">{{ $product->formatted_price }}</dd>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa Stok</dt>
                    <dd class="mt-1 text-base font-semibold {{ $product->stock <= 5 ? 'text-red-600 font-bold' : 'text-gray-900' }}">
                        {{ number_format($product->stock, 0, ',', '.') }} unit
                    </dd>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Produk</dt>
                    <dd class="mt-1 text-base font-semibold {{ $product->is_active ? 'text-green-700' : 'text-gray-600' }}">
                        {{ $product->is_active ? 'Aktif Dijual' : 'Dinonaktifkan' }}
                    </dd>
                </div>
            </dl>

            {{-- Deskripsi --}}
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-semibold text-gray-900 mb-2">Deskripsi Produk</h4>
                <div class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4 leading-relaxed whitespace-pre-line border border-gray-100">
                    {{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}
                </div>
            </div>

            {{-- Timestamps --}}
            <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-gray-500">
                <div>
                    <span class="font-medium text-gray-700">Dibuat pada:</span> {{ $product->created_at->translatedFormat('d F Y, H:i') }} ({{ $product->created_at->diffForHumans() }})
                </div>
                <div>
                    <span class="font-medium text-gray-700">Terakhir diubah:</span> {{ $product->updated_at->translatedFormat('d F Y, H:i') }} ({{ $product->updated_at->diffForHumans() }})
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                &larr; Kembali ke Daftar Produk
            </a>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDeleteModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 text-red-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-semibold text-gray-900" id="modal-title">
                            Konfirmasi Hapus Produk
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus produk <span id="deleteProductName" class="font-bold text-gray-800"></span>? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition-colors">
                        Ya, Hapus Data
                    </button>
                </form>
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(productId, productName, deleteUrl) {
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteForm').action = deleteUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection
