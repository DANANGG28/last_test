<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard beserta ringkasan statistik produk dan pengguna.
     */
    public function index(): View
    {
        return view('dashboard.index', [
            // Statistik Pengguna
            'totalUsers'       => User::count(),
            'todayUsers'       => User::whereDate('created_at', today())->count(),
            'recentUsers'      => User::latest()->take(5)->get(),

            // Statistik Pengelolaan Produk
            'totalProducts'    => Product::count(),
            'activeProducts'   => Product::where('is_active', true)->count(),
            'lowStockProducts' => Product::where('stock', '<=', 5)->count(),
            'recentProducts'   => Product::latest('id')->take(5)->get(),
        ]);
    }
}
