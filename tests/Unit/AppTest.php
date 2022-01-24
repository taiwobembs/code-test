<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AppTest extends TestCase
{
    public function test_getProducts()
    {
        $response = $this->get('/api/v1/getProducts');
        $this->assertEquals(200, $response->status());
    }

    public function test_getProduct()
    {
        $response = $this->get('/api/v1/getProduct/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_getProductsForUser()
    {
        $response = $this->get('/api/v1/getProductsForUser/1');
        $this->assertEquals(200, $response->status());
    }

}
