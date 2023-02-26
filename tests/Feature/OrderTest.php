<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class OrderTest extends TestCase
{
    /** @test */
    public function it_stores_default_order()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "note" => null
        ];


        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertNotNull($order->shipping_date);
        $this->assertEquals($order->note, null);
    }

    /** @test */
    public function it_stores_pickup_order_with_default_pickup_location()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "pickup",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::PICKUP);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertNull($order->shipping_address);
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
        $this->assertEquals($order->pickup_location, "1");
    }

    /** @test */
    public function it_stores_pickup_order_with_selected_pickup_location()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "pickup",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "pickupLocation" => 2,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::PICKUP);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertNull($order->shipping_address);
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
        $this->assertEquals($order->pickup_location, "2");
    }

    /** @test */
    public function it_stores_delivery_order_with_shipping_address()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => "123 Main St",
          "shippingDate" => null,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, "123 Main St");
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
    }

    /** @test */
    public function it_stores_delivery_order_with_shipping_date()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => "2021-01-01",
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertEquals($order->shipping_date, "2021-01-01 00:00:00");
        $this->assertNull($order->note);
    }

    /** @test */
    public function it_stores_delivery_order_with_note()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "note" => "This is a note"
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertNotNull($order->shipping_date);
        $this->assertEquals($order->note, "This is a note");
    }

    /** @test */
    public function it_stores_delivery_order_with_shipping_address_and_shipping_date()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => "123 Main St",
          "shippingDate" => "2021-01-01",
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, "123 Main St");
        $this->assertEquals($order->shipping_date, "2021-01-01 00:00:00");
        $this->assertNull($order->note);
    }

    /** @test */
    public function it_stores_delivery_order_with_different_shipping_method_code()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "HOP",
          "shippingAddress" => null,
          "shippingDate" => null,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'HOP');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
    }

    /** @test */
    public function it_stores_delivery_order_with_different_shipping_method_code_and_shipping_address_and_shipping_date()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "HOP",
          "shippingAddress" => "123 Main St",
          "shippingDate" => "2021-01-01",
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'HOP');
        $this->assertEquals($order->shipping_address, "123 Main St");
        $this->assertEquals($order->shipping_date, "2021-01-01 00:00:00");
        $this->assertNull($order->note);
    }

    /** @test */
    public function it_stores_delivery_order_with_different_customer_key()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => "1234567890",
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
        $this->assertEquals($order->customer_key, "1234567890");
    }

    /** @test */
    public function it_stores_delivery_order_without_default_pickup_location()
    {
        $customer = User::factory()->create();
        $products = Product::factory()->count(5)->create();
        foreach ($products as $product) {
            $this->actingAs($customer)->post('/api/add-to-cart', [
              'sku' => $product->sku,
              'qty' => 1,
              'user_id' => $customer->id
            ]);
        }
        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);

        $checkout = [
          "customerKey" => null,
          "shippingMethod" => "delivery",
          "shippingMethodCode" => "VM",
          "shippingAddress" => null,
          "shippingDate" => null,
          "pickupLocation" => 2,
          "note" => null
        ];

        $response = $this->actingAs($customer)->post('/api/v2/request-order/'.$customer->id, $checkout);
        $response->assertStatus(302);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNull($cart);

        $order = Order::where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->order_status, Order::STATUS_REQUESTED);
        $this->assertEquals($order->shipping_method, Order::DELIVERY);
        $this->assertEquals($order->shipping_method_code, 'VM');
        $this->assertEquals($order->shipping_address, $customer->getCustomerShippingAddress());
        $this->assertNotNull($order->shipping_date);
        $this->assertNull($order->note);
        $this->assertNull($order->pickup_location);
        $this->assertNull($order->customer_key);
    }
}
