<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard.
     */
    public function index(): View
    {
        return view('dashboard.index', [
            'totalUsers'    => User::count(),
            'todayUsers'    => User::whereDate('created_at', today())->count(),
            'totalProducts' => Product::count(),
            'recentUsers'   => User::latest()->take(10)->get(),
        ]);
    }
}
