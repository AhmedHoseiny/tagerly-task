<?php

namespace Tests\Feature;

use Illuminate\Support\Collection;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    public function testItReturnsAllInventoryData()
    {
        $response = $this->json('get','api/inventory/index');
        $response->assertStatus(200)
            ->assertJsonStructure([[
                "id",
                "product_name",
                "vendor_name",
                "price",
                "most_selling",
                "customer_votes"
            ]]);
    }
}
