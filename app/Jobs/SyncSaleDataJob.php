<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Services\Regulators\RegulatorProviderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncSaleDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string The state to sync the sale data with
     */
    protected string $state;

    /**
     * @var Sale The sale data to sync
     */
    protected Sale $sale;

    /**
     * Create a new job instance for syncing sale data.
     */
    public function __construct(string $state, Sale $sale)
    {
        $this->state = $state;
        $this->sale = $sale;
    }

    /**
     * Sync the sale data with the state's API.
     */
    public function handle(): array
    {
        $provider = RegulatorProviderFactory::createProvider($this->state);
        return $provider->syncSale($this->sale);
    }
}
