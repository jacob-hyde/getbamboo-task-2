<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SyncHarvestedDataJob;
use App\Models\Harvest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Tests\TestCase;

class SyncHarvestedDataJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_syncing_harvested_data(): void
    {
        // Could have use Mockery for the job test
        Harvest::unsetEventDispatcher();
        $harvest = Harvest::factory()->create([
            'uuid' => Str::uuid(),
        ]);

        $stateUrl = Config::get('regulators.states.' . $harvest->state)['state_url'];

        $expectedResult = [
            'state_url' => $stateUrl,
            'endpoint' => 'harvest',
            'full_url' => $stateUrl . '/harvest',
            'data' => $this->getExpectedData($harvest),
        ];

        // Dispatch the job manually and capture the result
        $job = new SyncHarvestedDataJob($harvest->state, $harvest);
        $result = $job->handle();

        // Validate the returned result
        $this->assertEquals($expectedResult, $result);
    }

    public function test_syncing_harvested_data_with_custom_fields(): void
    {
        Harvest::unsetEventDispatcher();
        $harvest = Harvest::factory()->create([
            'uuid' => Str::uuid(),
            'state' => 'NM',
        ]);

        $stateUrl = Config::get('regulators.states.' . $harvest->state)['state_url'];

        $expectedResult = [
            'state_url' => $stateUrl,
            'endpoint' => 'harvest',
            'full_url' => $stateUrl . '/harvest',
            'data' => $this->getExpectedData($harvest),
        ];

        $job = new SyncHarvestedDataJob($harvest->state, $harvest);
        $result = $job->handle();

        $this->assertEquals($expectedResult, $result);
    }

    private function getExpectedData(Harvest $harvest): array
    {
        if ($harvest->state === 'NM') {
            return [
                'uuid' => $harvest->uuid,
                'strain' => $harvest->strain,
                'quantity' => $harvest->quantity,
                'unit' => $harvest->unit,
                'weight_grams' => $harvest->weight,
            ];
        }

        return [
            'uuid' => $harvest->uuid,
            'strain' => $harvest->strain,
            'quantity' => $harvest->quantity,
            'unit' => $harvest->unit,
            'weight' => $harvest->weight,
        ];
    }
}
