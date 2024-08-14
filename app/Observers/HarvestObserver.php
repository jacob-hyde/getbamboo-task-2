<?php

namespace App\Observers;

use App\Jobs\SyncHarvestedDataJob;
use App\Observers\Contracts\BaseSyncObserver;

class HarvestObserver extends BaseSyncObserver
{
    protected string $syncJobClass = SyncHarvestedDataJob::class;
}
