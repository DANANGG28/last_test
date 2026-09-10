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
        // Create an authenticated user for tests
        $this->user = User::factory()->create();
    }

    /**
     * Test unauthenticated guest cannot access products.
     */
    public function test_guest_cannot_access_product_pages(): void
    {
        $response = $this->get('/products');
        $response->assertRedirect(route('login'));

        $response = $this->get('/products/create');
        $response->assertRedirect(route('login'));
    }

    /**
     * Test user can view the products index page.
     */
    public function test_user_can_view_products_index_page(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }

    /**
     * Scenario 1: Berhasil menyimpan data produk valid.
     */
    public function test_user_can_create_product_with_valid_data(): void
    {
        $payload = [
            'name' => 'MacBook Pro M3',
            'code' => 'PRD-MBP-01',
            'category' => 'Elektronik',
            'price' => 25999000,
            'stock' => 15,
            'description' => 'Laptop bertenaga chip Apple M3 Pro.',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->user)->post('/products', $payload);

        $response->assertRedirect('/products');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'name' => 'MacBook Pro M3',
            'code' => 'PRD-MBP-01',
            'category' => 'Elektronik',
            'price' => 25999000.00,
            'stock' => 15,
            'is_active' => true,
        ]);
    }

    /**
     * Scenario 2: Gagal menyimpan data jika validasi tidak terpenuhi (required fields kosong).
     */
    public function test_create_product_fails_when_required_fields_are_missing(): void
    {
        $payload = [
            'name' => '',
            'code' => '',
            'category' => '',
            'price' => '',
            'stock' => '',
        ];

        $response = $this->actingAs($this->user)->post('/products', $payload);

        $response->assertSessionHasErrors(['name', 'code', 'category', 'price', 'stock']);
        $this->assertDatabaseCount('products', 0);
    }

    /**
     * Scenario 2b: Gagal menyimpan data jika kode produk sudah digunakan (unique validation).
     */
    public function test_create_product_fails_with_duplicate_code(): void
    {
        Product::factory()->create([
            'code' => 'PRD-DUP-01',
        ]);

        $payload = [
            'name' => 'Produk Lain',
            'code' => 'PRD-DUP-01',
            'category' => 'Elektronik',
            'price' => 50000,
            'stock' => 10,
        ];

        $response = $this->actingAs($this->user)->post('/products', $payload);

        $response->assertSessionHasErrors(['code']);
    }

    /**
     * Scenario 2c: Gagal menyimpan data jika harga atau stok bernilai negatif.
     */
    public function test_create_product_fails_with_negative_price_or_stock(): void
    {
        $payload = [
            'name' => 'Produk Minus',
            'code' => 'PRD-MIN-01',
            'category' => 'Elektronik',
            'price' => -1000,
            'stock' => -5,
        ];

        $response = $this->actingAs($this->user)->post('/products', $payload);

        $response->assertSessionHasErrors(['price', 'stock']);
    }

    /**
     * Test user can view single product detail.
     */
    public function test_user_can_view_product_detail(): void
    {
        $product = Product::factory()->create([
            'name' => 'Mechanical Keyboard RGB',
            'code' => 'PRD-KEY-01',
        ]);

        $response = $this->actingAs($this->user)->get("/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertSee('Mechanical Keyboard RGB');
        $response->assertSee('PRD-KEY-01');
    }

    /**
     * Scenario 3: Berhasil mengupdate data produk.
     */
    public function test_user_can_update_product_with_valid_data(): void
    {
        $product = Product::factory()->create([
            'name' => 'Old Product Name',
            'code' => 'PRD-OLD-01',
            'price' => 100000,
            'stock' => 10,
            'category' => 'Pakaian',
            'is_active' => true,
        ]);

        $updatedPayload = [
            'name' => 'Updated Product Name',
            'code' => 'PRD-NEW-01',
            'price' => 150000,
            'stock' => 25,
            'category' => 'Pakaian Pria',
            'description' => 'Deskripsi yang sudah diubah.',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->user)->put("/products/{$product->id}", $updatedPayload);

        $response->assertRedirect('/products');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'code' => 'PRD-NEW-01',
            'price' => 150000.00,
            'stock' => 25,
            'category' => 'Pakaian Pria',
            'description' => 'Deskripsi yang sudah diubah.',
            'is_active' => true,
        ]);
    }

    /**
     * Scenario 3b: Update data dapat mempertahankan kode yang sama tanpa error unique.
     */
    public function test_update_product_allows_keeping_same_code(): void
    {
        $product = Product::factory()->create([
            'name' => 'Produk Awal',
            'code' => 'PRD-SAME-01',
            'price' => 50000,
            'stock' => 5,
            'category' => 'Alat Tulis',
        ]);

        $updatedPayload = [
            'name' => 'Produk Awal Diedit',
            'code' => 'PRD-SAME-01', // kode yang sama
            'price' => 75000,
            'stock' => 8,
            'category' => 'Alat Tulis Kantor',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->user)->put("/products/{$product->id}", $updatedPayload);

        $response->assertRedirect('/products');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Produk Awal Diedit',
            'code' => 'PRD-SAME-01',
        ]);
    }

    /**
     * Scenario 3c: Update data gagal jika menggunakan kode produk lain.
     */
    public function test_update_product_fails_when_using_another_products_code(): void
    {
        $product1 = Product::factory()->create(['code' => 'PRD-FIRST-01']);
        $product2 = Product::factory()->create(['code' => 'PRD-SECOND-02']);

        $updatedPayload = [
            'name' => 'Update Product 2',
            'code' => 'PRD-FIRST-01', // duplicate with product1
            'price' => 20000,
            'stock' => 5,
            'category' => 'Umum',
        ];

        $response = $this->actingAs($this->user)->put("/products/{$product2->id}", $updatedPayload);

        $response->assertSessionHasErrors(['code']);
    }

    /**
     * Scenario 4: Berhasil menghapus data produk.
     */
    public function test_user_can_delete_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'Product To Be Deleted',
            'code' => 'PRD-DEL-01',
        ]);

        $response = $this->actingAs($this->user)->delete("/products/{$product->id}");

        $response->assertRedirect('/products');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test searching and filtering products.
     */
    public function test_products_can_be_filtered_and_searched(): void
    {
        Product::factory()->create([
            'name' => 'Sepatu Olahraga Running',
            'code' => 'PRD-SHOE-01',
            'category' => 'Pakaian',
        ]);

        Product::factory()->create([
            'name' => 'Kopi Arabika Gayo',
            'code' => 'PRD-COFF-02',
            'category' => 'Makanan & Minuman',
        ]);

        // Search by name
        $response = $this->actingAs($this->user)->get('/products?search=Sepatu');
        $response->assertSee('Sepatu Olahraga Running');
        $response->assertDontSee('Kopi Arabika Gayo');

        // Search by code
        $response = $this->actingAs($this->user)->get('/products?search=COFF');
        $response->assertSee('Kopi Arabika Gayo');
        $response->assertDontSee('Sepatu Olahraga Running');

        // Filter by category
        $response = $this->actingAs($this->user)->get('/products?category=Makanan+%26+Minuman');
        $response->assertSee('Kopi Arabika Gayo');
        $response->assertDontSee('Sepatu Olahraga Running');
    }

    /**
     * Test delete modal markup exists on index and show pages.
     */
    public function test_product_views_contain_delete_modal_and_csrf(): void
    {
        $product = Product::factory()->create([
            'name' => 'Produk Modal Test',
            'code' => 'PRD-MODAL-01',
        ]);

        // Index page contains modal and delete trigger
        $indexResponse = $this->actingAs($this->user)->get('/products');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('id="deleteModal"', false);
        $indexResponse->assertSee('id="deleteForm"', false);
        $indexResponse->assertSee('openDeleteModal', false);
        $indexResponse->assertSee('closeDeleteModal', false);
        $indexResponse->assertSee('Ya, Hapus Produk');
        $indexResponse->assertSee('Batal');

        // Show page contains modal and delete trigger
        $showResponse = $this->actingAs($this->user)->get("/products/{$product->id}");
        $showResponse->assertStatus(200);
        $showResponse->assertSee('id="deleteModal"', false);
        $showResponse->assertSee('id="deleteForm"', false);
        $showResponse->assertSee('openDeleteModal', false);
        $showResponse->assertSee('closeDeleteModal', false);
        $showResponse->assertSee('Ya, Hapus Produk');
        $showResponse->assertSee('Batal');
    }
}
