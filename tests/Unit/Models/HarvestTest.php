<?php

namespace Tests\Unit\Models;

use App\Models\Harvest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HarvestTest extends TestCase
{
    use RefreshDatabase;

    public function test_harvest_model_fires_observer_on_create()
    {
        $harvest = Harvest::factory()->make();
        $this->assertEmpty($harvest->uuid);
        $harvest->save();
        $this->assertNotEmpty($harvest->uuid);
    }
}
