<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed 15 produk dummy untuk testing.
     */
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Laptop ASUS VivoBook 14',
                'code'        => 'PRD-001',
                'category'    => 'Elektronik',
                'price'       => 7500000,
                'stock'       => 25,
                'description' => 'Laptop ringan dengan prosesor Intel Core i5, RAM 8GB, SSD 512GB.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Mouse Logitech M331 Silent',
                'code'        => 'PRD-002',
                'category'    => 'Aksesoris',
                'price'       => 185000,
                'stock'       => 150,
                'description' => 'Mouse wireless silent click, ergonomis dan hemat baterai.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Keyboard Mechanical Rexus Daxa M84',
                'code'        => 'PRD-003',
                'category'    => 'Aksesoris',
                'price'       => 650000,
                'stock'       => 40,
                'description' => 'Keyboard mekanikal 75% layout, hot-swappable, RGB backlit.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Monitor Samsung 24" FHD',
                'code'        => 'PRD-004',
                'category'    => 'Elektronik',
                'price'       => 2100000,
                'stock'       => 18,
                'description' => 'Monitor 24 inch Full HD IPS panel, 75Hz refresh rate.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Headset HyperX Cloud Stinger',
                'code'        => 'PRD-005',
                'category'    => 'Aksesoris',
                'price'       => 450000,
                'stock'       => 60,
                'description' => 'Headset gaming ringan dengan mikrofon noise-cancelling.',
                'is_active'   => true,
            ],
            [
                'name'        => 'SSD Samsung 870 EVO 500GB',
                'code'        => 'PRD-006',
                'category'    => 'Komponen',
                'price'       => 850000,
                'stock'       => 35,
                'description' => 'SSD SATA 2.5 inch, kecepatan baca hingga 560 MB/s.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Webcam Logitech C920 HD Pro',
                'code'        => 'PRD-007',
                'category'    => 'Aksesoris',
                'price'       => 1200000,
                'stock'       => 22,
                'description' => 'Webcam 1080p dengan autofocus dan dual microphone stereo.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Flash Drive Kingston 64GB',
                'code'        => 'PRD-008',
                'category'    => 'Penyimpanan',
                'price'       => 95000,
                'stock'       => 200,
                'description' => 'USB 3.2 Gen 1 flash drive, kecepatan baca hingga 200 MB/s.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Router TP-Link Archer AX23',
                'code'        => 'PRD-009',
                'category'    => 'Jaringan',
                'price'       => 750000,
                'stock'       => 15,
                'description' => 'Router Wi-Fi 6 dual band, kecepatan hingga 1.8 Gbps.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Printer Epson L3210',
                'code'        => 'PRD-010',
                'category'    => 'Elektronik',
                'price'       => 2350000,
                'stock'       => 10,
                'description' => 'Printer inkjet multifungsi (print, scan, copy) dengan ink tank.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Tas Laptop Targus 15.6"',
                'code'        => 'PRD-011',
                'category'    => 'Aksesoris',
                'price'       => 350000,
                'stock'       => 45,
                'description' => 'Tas laptop ringan dan tahan air dengan padding tebal.',
                'is_active'   => true,
            ],
            [
                'name'        => 'RAM DDR4 8GB Corsair Vengeance',
                'code'        => 'PRD-012',
                'category'    => 'Komponen',
                'price'       => 380000,
                'stock'       => 55,
                'description' => 'RAM DDR4 3200MHz, low-profile heatspreader.',
                'is_active'   => false,
            ],
            [
                'name'        => 'Kabel HDMI 2.1 Ugreen 2M',
                'code'        => 'PRD-013',
                'category'    => 'Aksesoris',
                'price'       => 125000,
                'stock'       => 80,
                'description' => 'Kabel HDMI 2.1 mendukung 4K@120Hz dan 8K@60Hz.',
                'is_active'   => true,
            ],
            [
                'name'        => 'UPS APC BX650LI-MS 650VA',
                'code'        => 'PRD-014',
                'category'    => 'Elektronik',
                'price'       => 1150000,
                'stock'       => 8,
                'description' => 'UPS line-interactive 650VA/325W, proteksi lonjakan arus.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Mousepad Gaming Steelseries QcK',
                'code'        => 'PRD-015',
                'category'    => 'Aksesoris',
                'price'       => 175000,
                'stock'       => 0,
                'description' => 'Mousepad besar 450x400mm, permukaan kain micro-woven.',
                'is_active'   => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
