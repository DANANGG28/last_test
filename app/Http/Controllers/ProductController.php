<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $status = $request->query('status');

        $query = Product::query();

        if (!empty($search)) {
            $query->search($search);
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if ($status !== null && $status !== '') {
            $query->where('is_active', $status === 'active');
        }

        $products = $query->latest('id')->paginate(10)->withQueryString();

        // Calculate statistics for the dashboard/index widgets
        $stats = [
            'total' => Product::count(),
            'active' => Product::where('is_active', true)->count(),
            'inactive' => Product::where('is_active', false)->count(),
            'low_stock' => Product::where('stock', '<=', 5)->count(),
        ];

        // Available categories for filtering
        $categories = Product::select('category')->distinct()->pluck('category')->filter()->values();

        return view('products.index', compact('products', 'search', 'category', 'status', 'stats', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $defaultCategories = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Kesehatan & Kecantikan', 'Alat Tulis', 'Otomotif', 'Lainnya'];
        $existingCategories = Product::select('category')->distinct()->pluck('category')->filter()->values()->toArray();
        $categories = array_unique(array_merge($defaultCategories, $existingCategories));

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', "Produk \"{$product->name}\" (Kode: {$product->code}) berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $defaultCategories = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Kesehatan & Kecantikan', 'Alat Tulis', 'Otomotif', 'Lainnya'];
        $existingCategories = Product::select('category')->distinct()->pluck('category')->filter()->values()->toArray();
        $categories = array_unique(array_merge($defaultCategories, $existingCategories));

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', "Data produk \"{$product->name}\" berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', "Produk \"{$name}\" berhasil dihapus.");
    }
}
