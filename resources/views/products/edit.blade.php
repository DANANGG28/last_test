@extends('layouts.app')
@section('title', 'Edit Produk: ' . $product->name)
@section('header', 'Edit Produk')

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
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-mono font-semibold bg-gray-100 text-gray-700">
            ID: #{{ $product->id }}
        </span>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Perbarui Data Produk</h2>
                <p class="text-sm text-gray-500 mt-0.5">Ubah informasi produk <strong class="text-gray-700">{{ $product->name }}</strong>.</p>
            </div>
            <div>
                <span class="font-mono text-xs px-2.5 py-1 bg-blue-50 text-blue-700 rounded-md font-semibold border border-blue-100">
                    {{ $product->code }}
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('products.update', $product) }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Product Code --}}
                <div>
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-1">
                        Kode Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="code"
                           id="code"
                           value="{{ old('code', $product->code) }}"
                           placeholder="Contoh: PRD-001"
                           class="w-full font-mono uppercase px-4 py-2.5 text-sm rounded-lg border @error('code') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-xs text-gray-400 mt-1">Kode unik identifikasi produk (SKU/Barcode).</p>
                    @error('code')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $product->name) }}"
                           placeholder="Contoh: Laptop Asus Zenbook 14"
                           class="w-full px-4 py-2.5 text-sm rounded-lg border @error('name') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               name="category"
                               id="category"
                               list="category-suggestions"
                               value="{{ old('category', $product->category) }}"
                               placeholder="Pilih atau ketik kategori baru"
                               class="w-full px-4 py-2.5 text-sm rounded-lg border @error('category') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <datalist id="category-suggestions">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Pilih dari rekomendasi atau ketik kategori baru.</p>
                    @error('category')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price --}}
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">
                        Harga (IDR) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-lg">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 font-medium text-sm">
                            Rp
                        </div>
                        <input type="number"
                               name="price"
                               id="price"
                               min="0"
                               step="0.01"
                               value="{{ old('price', $product->price) }}"
                               placeholder="0"
                               class="w-full pl-10 pr-4 py-2.5 text-sm rounded-lg border @error('price') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                    @error('price')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stock --}}
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">
                        Jumlah Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           name="stock"
                           id="stock"
                           min="0"
                           step="1"
                           value="{{ old('stock', $product->stock) }}"
                           placeholder="0"
                           class="w-full px-4 py-2.5 text-sm rounded-lg border @error('stock') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-xs text-gray-400 mt-1">Jumlah unit yang tersedia saat ini.</p>
                    @error('stock')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Is Active Toggle --}}
                <div class="flex flex-col justify-center">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Publikasi
                    </label>
                    <div class="flex items-center space-x-3 mt-1">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   class="sr-only peer"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">Produk Aktif & Dijual</span>
                        </label>
                    </div>
                    @error('is_active')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                    Deskripsi Produk (Opsional)
                </label>
                <textarea name="description"
                          id="description"
                          rows="4"
                          placeholder="Tuliskan spesifikasi, deskripsi rinci, atau catatan produk..."
                          class="w-full px-4 py-2.5 text-sm rounded-lg border @error('description') border-red-300 ring-1 ring-red-500 bg-red-50/30 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('products.show', $product) }}"
                   class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Lihat Detail Produk &rarr;
                </a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('products.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
