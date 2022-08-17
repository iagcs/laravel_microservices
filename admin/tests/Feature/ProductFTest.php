<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_products()
    {
        $response = $this->get('/api/products');
        
        $response->assertStatus(200);
    }

    public function test_find_product()
    {
        $response = $this->get('/api/products/search/8');
        
        $response->assertStatus(200);
    }

    public function test_create_product() 
    {
        $product = Product::factory()->make()->toArray();

        $response = $this->post('api/products', [
            'title' => $product['title'],
            'image' => $product['image']
        ]);

        $this->assertDatabaseHas('products', $product);

        $response->assertStatus(201);
    }

    public function test_update_product() 
    {
        $product = Product::factory()->create()->toArray();

        $product2 = Product::factory()->make([
            'title' => $product['title']
        ]);

        $response = $this->post('api/products/' . $product['id'], [
            'title' => $product2->title,
            'image' => $product2->image
        ]);

        $this->assertNotEquals($product['title'], $product2->title);

        $response->assertStatus(201);
    }

    public function test_delete_product() 
    {
        $product = Product::factory()->create()->toArray();

        $response = $this->delete('api/products/' . $product['id']);

        $this->assertDatabaseMissing('products', $product);

        $response->assertStatus(204);
    }
}
