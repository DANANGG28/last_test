<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * Skenario Tambahan: Tamu (Guest) diarahkan ke halaman login jika belum terotentikasi.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('products.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Skenario Tambahan: Berhasil menampilkan halaman index dengan pencarian & pagination.
     */
    public function test_authenticated_user_can_view_product_list_and_search(): void
    {
        $productA = Product::factory()->create([
            'name' => 'Laptop Asus ROG Strix',
            'code' => 'PRD-ASUS01',
            'category' => 'Elektronik',
        ]);

        $productB = Product::factory()->create([
            'name' => 'Kemeja Batik Katun',
            'code' => 'PRD-BTK02',
            'category' => 'Pakaian',
        ]);

        // Cek halaman index menampilkan kedua produk
        $response = $this->actingAs($this->user)->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertSee('Laptop Asus ROG Strix');
        $response->assertSee('Kemeja Batik Katun');

        // Cek filter pencarian berdasarkan nama
        $searchResponse = $this->actingAs($this->user)->get(route('products.index', ['search' => 'Asus']));
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Laptop Asus ROG Strix');
        $searchResponse->assertDontSee('Kemeja Batik Katun');

        // Cek filter pencarian berdasarkan kode
        $codeSearchResponse = $this->actingAs($this->user)->get(route('products.index', ['search' => 'BTK02']));
        $codeSearchResponse->assertStatus(200);
        $codeSearchResponse->assertSee('Kemeja Batik Katun');
        $codeSearchResponse->assertDontSee('Laptop Asus ROG Strix');
    }

    /**
     * Skenario 1 (Spesifikasi): Berhasil menyimpan data produk valid.
     */
    public function test_authenticated_user_can_create_valid_product(): void
    {
        $payload = [
            'name' => 'Mouse Gaming Wireless',
            'code' => 'PRD-MOU001',
            'category' => 'Elektronik',
            'price' => 350000,
            'stock' => 25,
            'description' => 'Mouse gaming wireless dengan sensor optik presisi tinggi.',
            'is_active' => '1',
        ];

        $response = $this->actingAs($this->user)->post(route('products.store'), $payload);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'name' => 'Mouse Gaming Wireless',
            'code' => 'PRD-MOU001',
            'category' => 'Elektronik',
            'price' => '350000.00',
            'stock' => 25,
            'is_active' => true,
        ]);
    }

    /**
     * Skenario 2 (Spesifikasi): Gagal menyimpan data jika validasi tidak terpenuhi.
     */
    public function test_product_creation_fails_when_validation_not_met(): void
    {
        // 1. Data kosong / wajib diisi
        $emptyResponse = $this->actingAs($this->user)->post(route('products.store'), []);
        $emptyResponse->assertSessionHasErrors(['name', 'code', 'category', 'price', 'stock']);

        // 2. Kode produk duplikat (unique constraint)
        Product::factory()->create(['code' => 'PRD-DUP001']);

        $duplicateResponse = $this->actingAs($this->user)->post(route('products.store'), [
            'name' => 'Produk Baru',
            'code' => 'PRD-DUP001',
            'category' => 'Elektronik',
            'price' => 100000,
            'stock' => 10,
        ]);
        $duplicateResponse->assertSessionHasErrors(['code']);

        // 3. Nilai harga dan stok negatif
        $negativeResponse = $this->actingAs($this->user)->post(route('products.store'), [
            'name' => 'Produk Minus',
            'code' => 'PRD-MIN001',
            'category' => 'Elektronik',
            'price' => -50000,
            'stock' => -5,
        ]);
        $negativeResponse->assertSessionHasErrors(['price', 'stock']);
    }

    /**
     * Skenario 3 (Spesifikasi): Berhasil mengupdate data.
     */
    public function test_authenticated_user_can_update_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'Keyboard Mechanical Lama',
            'code' => 'PRD-KB001',
            'category' => 'Elektronik',
            'price' => 500000,
            'stock' => 10,
            'is_active' => true,
        ]);

        $updatePayload = [
            'name' => 'Keyboard Mechanical RGB Pro',
            'code' => 'PRD-KB001', // tetap gunakan kode sendiri (ignore rule)
            'category' => 'Elektronik & Komputer',
            'price' => 750000,
            'stock' => 15,
            'description' => 'Versi upgrade dengan switch hot-swappable.',
            'is_active' => '0', // diubah jadi nonaktif
        ];

        $response = $this->actingAs($this->user)
            ->put(route('products.update', $product), $updatePayload);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Keyboard Mechanical RGB Pro',
            'code' => 'PRD-KB001',
            'category' => 'Elektronik & Komputer',
            'price' => '750000.00',
            'stock' => 15,
            'is_active' => false,
        ]);
    }

    /**
     * Skenario 4 (Spesifikasi): Berhasil menghapus data.
     */
    public function test_authenticated_user_can_delete_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'Produk Yang Akan Dihapus',
            'code' => 'PRD-DEL001',
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'code' => 'PRD-DEL001',
        ]);
    }
}
