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
        Product::truncate();

        $products = [
            [
                'name'        => 'Laptop Asus ZenBook 14 OLED',
                'code'        => 'PRD-ELK001',
                'category'    => 'Elektronik',
                'price'       => 14500000,
                'stock'       => 15,
                'description' => 'Laptop ultra-thin dengan layar 14 inci 2.8K OLED, prosesor Intel Core Ultra 7, RAM 16GB, dan SSD 1TB.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Smartphone Samsung Galaxy S24',
                'code'        => 'PRD-ELK002',
                'category'    => 'Elektronik',
                'price'       => 12999000,
                'stock'       => 20,
                'description' => 'Flagship smartphone dengan fitur Galaxy AI canggih, kamera 50MP, layar Dynamic AMOLED 2X 120Hz.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Mouse Wireless Logitech MX Master 3S',
                'code'        => 'PRD-ELK003',
                'category'    => 'Elektronik',
                'price'       => 1450000,
                'stock'       => 35,
                'description' => 'Mouse ergonomis premium dengan sensor 8K DPI Darkfield, scroll elektromagnetik MagSpeed, dan tombol hening.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Keyboard Mechanical Keychron K2 Pro',
                'code'        => 'PRD-ELK004',
                'category'    => 'Elektronik',
                'price'       => 1250000,
                'stock'       => 4,
                'description' => 'Keyboard mechanical wireless 75% compact dengan switch hot-swappable dan RGB backlight.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Headset Wireless Sony WH-1000XM5',
                'code'        => 'PRD-ELK005',
                'category'    => 'Elektronik',
                'price'       => 4999000,
                'stock'       => 12,
                'description' => 'Headphone noise cancelling terbaik di kelasnya dengan Auto NC Optimizer dan daya tahan baterai hingga 30 jam.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Kemeja Batik Tulis Pria Premium',
                'code'        => 'PRD-FSH001',
                'category'    => 'Pakaian & Fashion',
                'price'       => 385000,
                'stock'       => 45,
                'description' => 'Batik tulis motif modern bahan katun primisima halus dilapisi furing trikot berkualitas tinggi.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Jaket Hoodie Casual Katun Fleece',
                'code'        => 'PRD-FSH002',
                'category'    => 'Pakaian & Fashion',
                'price'       => 250000,
                'stock'       => 30,
                'description' => 'Hoodie unisex berbahan cotton fleece 280 gsm hangat dan nyaman untuk aktivitas harian.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Kopi Arabika Gayo Single Origin 250g',
                'code'        => 'PRD-FNB001',
                'category'    => 'Makanan & Minuman',
                'price'       => 85000,
                'stock'       => 60,
                'description' => 'Biji kopi pilihan dari dataran tinggi Aceh Gayo, dipanggang dengan profil medium roast dengan cita rasa floral dan fruity.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Meja Kerja Minimalis Kayu Jati',
                'code'        => 'PRD-FRN001',
                'category'    => 'Perabotan Rumah',
                'price'       => 1850000,
                'stock'       => 8,
                'description' => 'Meja kerja estetik dengan bahan kayu jati solid, finishing natural matte, dan rangka besi hollow kokoh.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Kursi Ergonomis Kantor Sihoo M57',
                'code'        => 'PRD-FRN002',
                'category'    => 'Perabotan Rumah',
                'price'       => 2150000,
                'stock'       => 3,
                'description' => 'Kursi kantor ergonomis jaring mesh breathable dengan lumbar support 2 arah dan sandaran tangan 3D.',
                'is_active'   => true,
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['code' => $data['code']],
                $data
            );
        }
    }
}
