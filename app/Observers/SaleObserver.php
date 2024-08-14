<?php

namespace App\Observers;

use App\Jobs\SyncSaleDataJob;
use App\Observers\Contracts\BaseSyncObserver;

class SaleObserver extends BaseSyncObserver
{
    protected string $syncJobClass = SyncSaleDataJob::class;
}
