@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('main')
<div class="space-y-6">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition">
            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Produk
        </a>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Produk</h3>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data produk di bawah ini.</p>
        </div>

        <form method="POST" action="{{ route('products.store') }}" class="p-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('name') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                           placeholder="Contoh: Laptop ASUS VivoBook">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
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
                           value="{{ old('code') }}"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('code') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                           placeholder="Contoh: PRD-016">
                    @error('code')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
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
                           value="{{ old('category') }}"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('category') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                           placeholder="Contoh: Elektronik">
                    @error('category')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Harga (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="price"
                           name="price"
                           value="{{ old('price') }}"
                           min="0"
                           step="0.01"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('price') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                           placeholder="0">
                    @error('price')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="stock"
                           name="stock"
                           value="{{ old('stock', 0) }}"
                           min="0"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('stock') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                           placeholder="0">
                    @error('stock')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select id="is_active"
                            name="is_active"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('description') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                              placeholder="Deskripsi produk (opsional)">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
