@extends('layouts.app')
@section('title', 'Detail Produk')
@section('header', 'Detail Produk')

@section('main')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
            @if ($product->is_active)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
            @endif
        </div>

        {{-- Detail --}}
        <div class="px-6 py-5">
            <dl class="space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Kode Produk</dt>
                    <dd class="col-span-2 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $product->code }}</span>
                    </dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Nama Produk</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ $product->name }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ $product->category }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Harga</dt>
                    <dd class="col-span-2 text-sm font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Stok</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ number_format($product->stock) }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ $product->description ?: '-' }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ $product->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <dt class="text-sm font-medium text-gray-500">Diperbarui</dt>
                    <dd class="col-span-2 text-sm text-gray-900">{{ $product->updated_at->format('d M Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <a href="{{ route('products.index') }}"
               class="text-sm font-medium text-gray-600 hover:text-gray-800 transition">
                &larr; Kembali ke Daftar
            </a>
            <div class="flex items-center space-x-3">
                <a href="{{ route('products.edit', $product) }}"
                   class="px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition">
                    Edit
                </a>
                <form method="POST" action="{{ route('products.destroy', $product) }}"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
