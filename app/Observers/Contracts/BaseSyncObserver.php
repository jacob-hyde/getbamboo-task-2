<?php

namespace App\Observers\Contracts;

use App\Models\Harvest;
use App\Models\Sale;
use Illuminate\Support\Str;

// Rather than Harvest|Sale types we could just use Model or a base class that both Harvest and Sale extend
abstract class BaseSyncObserver
{
    /**
     * The class name of the job that will be dispatched to sync the model.
     */
    protected string $syncJobClass;

    /**
     * When a model is creating, generate a UUID if one is not provided.
     */
    public function creating(Harvest|Sale $model): void
    {
        if (empty($model->uuid)) {
            $model->uuid = (string) Str::uuid();
        }
    }

    /**
     * When a model is created, call @see dispatchSyncJob to sync the model.
     */
    public function created(Harvest|Sale $model): void
    {
        $this->dispatchSyncJob($model);
    }

    /**
     * Dispatch a job to sync the model to the regulator provider.
     */
    protected function dispatchSyncJob(Harvest|Sale $model): void
    {
        $state = $model->state;
        $jobClass = $this->syncJobClass;

        if (class_exists($jobClass)) {
            $jobClass::dispatchSync($state, $model); // Dispatch the job immediately, but could be queued
        }
    }
}
