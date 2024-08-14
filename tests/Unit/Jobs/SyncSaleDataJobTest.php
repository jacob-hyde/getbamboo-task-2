<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SyncSaleDataJob;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Tests\TestCase;

class SyncSaleDataJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_syncing_sale_data(): void
    {
        // Could have use Mockery for the job test
        Sale::unsetEventDispatcher();
        $sale = Sale::factory()->create([
            'uuid' => Str::uuid(),
        ]);

        $stateUrl = Config::get('regulators.states.' . $sale->state)['state_url'];

        $expectedResult = [
            'state_url' => $stateUrl,
            'endpoint' => 'sale',
            'full_url' => $stateUrl . '/sale',
            'data' => $this->getExpectedData($sale),
        ];

        // Dispatch the job manually and capture the result
        $job = new SyncSaleDataJob($sale->state, $sale);
        $result = $job->handle();

        // Validate the returned result
        $this->assertEquals($expectedResult, $result);
    }

    public function test_syncing_sale_data_with_custom_fields(): void
    {
        Sale::unsetEventDispatcher();
        $sale = Sale::factory()->create([
            'uuid' => Str::uuid(),
            'state' => 'NM',
        ]);

        $stateUrl = Config::get('regulators.states.' . $sale->state)['state_url'];

        $expectedResult = [
            'state_url' => $stateUrl,
            'endpoint' => 'sale',
            'full_url' => $stateUrl . '/sale',
            'data' => $this->getExpectedData($sale),
        ];

        $job = new SyncSaleDataJob($sale->state, $sale);
        $result = $job->handle();

        $this->assertEquals($expectedResult, $result);
    }

    private function getExpectedData(Sale $sale): array
    {
        if ($sale->state === 'NM') {
            return [
                'uuid' => $sale->uuid,
                'strain' => $sale->strain,
                'quantity' => $sale->quantity,
                'unit' => $sale->unit,
                'weight_grams' => $sale->weight,
            ];
        }

        return [
            'uuid' => $sale->uuid,
            'strain' => $sale->strain,
            'quantity' => $sale->quantity,
            'unit' => $sale->unit,
            'weight' => $sale->weight,
        ];
    }
}
