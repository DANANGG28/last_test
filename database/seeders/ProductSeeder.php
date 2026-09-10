<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'MacBook Pro 14" M3 Pro',
                'code' => 'PRD-LPT-001',
                'category' => 'Elektronik',
                'price' => 31499000,
                'stock' => 12,
                'description' => 'Laptop profesional Apple Silicon dengan performa komputasi tinggi dan efisiensi daya luar biasa.',
                'is_active' => true,
            ],
            [
                'name' => 'Logitech MX Master 3S Wireless Mouse',
                'code' => 'PRD-MOU-002',
                'category' => 'Elektronik',
                'price' => 1650000,
                'stock' => 35,
                'description' => 'Mouse ergonomis nirkabel dengan scrolling elektromagnetik MagSpeed dan sensor 8000 DPI.',
                'is_active' => true,
            ],
            [
                'name' => 'Keychron K2 Pro Mechanical Keyboard',
                'code' => 'PRD-KEY-003',
                'category' => 'Elektronik',
                'price' => 1899000,
                'stock' => 4,
                'description' => 'Keyboard mekanik nirkabel QMK/VIA dengan switch hot-swappable dan backlight RGB.',
                'is_active' => true,
            ],
            [
                'name' => 'Biji Kopi Arabika Specialty Gayo 250g',
                'code' => 'PRD-KOP-004',
                'category' => 'Makanan & Minuman',
                'price' => 85000,
                'stock' => 50,
                'description' => 'Biji kopi sangrai kualitas specialty dari dataran tinggi Gayo Aceh dengan cita rasa fruity dan aroma semerbak.',
                'is_active' => true,
            ],
            [
                'name' => 'Kemeja Katun Oxford Premium Slim Fit',
                'code' => 'PRD-KMY-005',
                'category' => 'Pakaian',
                'price' => 249000,
                'stock' => 2,
                'description' => 'Kemeja formal dan kasual berbahan 100% katun oxford lembut, breathable, dan nyaman digunakan seharian.',
                'is_active' => true,
            ],
            [
                'name' => 'Buku Catatan Hardcover Dotted A5',
                'code' => 'PRD-BKO-006',
                'category' => 'Alat Tulis',
                'price' => 65000,
                'stock' => 0,
                'description' => 'Jurnal catatan hardcover dengan kertas 100 gsm acid-free yang tidak tembus tinta pulpen gel/fountain pen.',
                'is_active' => false,
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}
