<?php

namespace Tests\Unit\Models;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_harvest_model_fires_observer_on_create()
    {
        $sale = Sale::factory()->make();
        $this->assertEmpty($sale->uuid);
        $sale->save();
        $this->assertNotEmpty($sale->uuid);
    }
}
