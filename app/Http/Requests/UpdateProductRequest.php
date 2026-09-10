<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'code'        => ['required', 'string', 'max:100', Rule::unique('products', 'code')->ignore($this->route('product'))],
            'category'    => ['required', 'string', 'max:255'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama produk wajib diisi.',
            'code.required'     => 'Kode produk wajib diisi.',
            'code.unique'       => 'Kode produk sudah digunakan.',
            'category.required' => 'Kategori wajib diisi.',
            'price.required'    => 'Harga wajib diisi.',
            'price.min'         => 'Harga tidak boleh bernilai negatif.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.min'         => 'Stok tidak boleh bernilai negatif.',
        ];
    }
}
