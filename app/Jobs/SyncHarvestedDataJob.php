<?php

namespace App\Jobs;

use App\Models\Harvest;
use App\Services\Regulators\RegulatorProviderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncHarvestedDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string The state to sync the harvested data with
     */
    protected string $state;

    /**
     * @var Harvest The harvested data to sync
     */
    protected Harvest $harvest;

    /**
     * Create a new job instance for syncing harvested data.
     */
    public function __construct(string $state, Harvest $harvest)
    {
        $this->state = $state;
        $this->harvest = $harvest;
    }

    /**
     * Sync the harvested data with the state's API.
     */
    public function handle(): array
    {
        $provider = RegulatorProviderFactory::createProvider($this->state);
        return $provider->syncHarvested($this->harvest);
    }
}
