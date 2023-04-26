<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestPriceCartTest extends TestCase
{
    /** @test */
    public function it_returns_error_if_cookie_is_not_set()
    {
        $product = Product::factory()->create();

        $response = $this->post('/api/request/add-to-cart', [
            'product_sku' => $product->sku,
            'quantity' => 1,
          ]);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Invalid auth ID',
        ]);

    }

    /** @test */
    public function it_returns_validation_error_if_product_is_missing()
    {
        $product = Product::factory()->create();
        $user_id = Str::uuid();

        $response = $this->withCookie('auth_id', $user_id)
          ->post('/api/request/add-to-cart', [
            'quantity' => 1,
          ]);

        $response->assertStatus(422);
        $response->assertJson([
            'error' => 'Something went wrong, try again!',
        ]);
    }

    /** @test */
    public function it_stores_single_product_to_cart_request()
    {
        $product = Product::factory()->create();
        $user_id = Str::uuid();

        $response = $this->withCookie('auth_id', $user_id)
          ->post('/api/request/add-to-cart', [
            'product_sku' => $product->sku,
            'quantity' => 1,
          ]);

        $response->assertStatus(200);
    }
}
