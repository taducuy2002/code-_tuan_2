<?php 
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'price' => 100
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Thêm dữ liệu thành công'
                 ]);

        // Kiểm tra sản phẩm đã được lưu trong database
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 100
        ]);
    }

    public function test_get_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name',
                         'price',
                         'created_at',
                         'updated_at'
                     ]
                 ])
                 ->assertJsonCount(3);
    }
}
