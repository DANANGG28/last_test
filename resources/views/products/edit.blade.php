@extends('layouts.app')
@section('title', 'Edit Produk')
@section('header', 'Edit Produk: ' . $product->name)

@section('main')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama produk">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kode & Kategori --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Produk <span class="text-red-500">*</span></label>
                    <input id="code" type="text" name="code" value="{{ old('code', $product->code) }}" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('code') border-red-500 @enderror"
                           placeholder="Contoh: PRD-001">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <input id="category" type="text" name="category" value="{{ old('category', $product->category) }}" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('category') border-red-500 @enderror"
                           placeholder="Contoh: Elektronik">
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Harga & Stok --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" min="0" step="0.01" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                    <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('description') border-red-500 @enderror"
                          placeholder="Deskripsi produk (opsional)">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center">
                <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Produk aktif</label>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
