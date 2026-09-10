@extends('layouts.app')
@section('title', 'Edit Produk: ' . $product->name)
@section('header', 'Edit Produk')

@section('main')
<div class="max-w-3xl mx-auto">
    {{-- Card Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Edit Data: {{ $product->name }}</h3>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Produk --}}
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $product->name) }}"
                           placeholder="Contoh: Laptop Asus ROG Strix"
                           class="w-full px-4 py-2 border @error('name') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kode Produk --}}
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                        Kode Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="code"
                           name="code"
                           value="{{ old('code', $product->code) }}"
                           placeholder="Contoh: PRD-ELK001"
                           class="w-full px-4 py-2 border @error('code') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm font-mono uppercase focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="category"
                           name="category"
                           value="{{ old('category', $product->category) }}"
                           placeholder="Contoh: Elektronik, Pakaian, Makanan..."
                           list="categories-list"
                           class="w-full px-4 py-2 border @error('category') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           required>
                    <datalist id="categories-list">
                        <option value="Elektronik">
                        <option value="Pakaian & Fashion">
                        <option value="Makanan & Minuman">
                        <option value="Perabotan Rumah">
                        <option value="Kesehatan & Kecantikan">
                        <option value="Olahraga">
                    </datalist>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Harga (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 text-sm">
                            Rp
                        </div>
                        <input type="number"
                               id="price"
                               name="price"
                               value="{{ old('price', $product->price) }}"
                               min="0"
                               step="any"
                               placeholder="0"
                               class="w-full pl-10 pr-4 py-2 border @error('price') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                               required>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                        Stok Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="stock"
                           name="stock"
                           value="{{ old('stock', $product->stock) }}"
                           min="0"
                           step="1"
                           placeholder="0"
                           class="w-full px-4 py-2 border @error('stock') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                           required>
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Produk (Opsional)
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              placeholder="Tuliskan keterangan detail mengenai produk ini..."
                              class="w-full px-4 py-2 border @error('description') border-red-300 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Aktif --}}
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                        <label for="is_active" class="ml-2 block text-sm font-medium text-gray-900 cursor-pointer">
                            Produk ini aktif dan dapat dipesan
                        </label>
                    </div>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-4 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('products.index') }}"
                   class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium shadow-sm transition-colors">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
