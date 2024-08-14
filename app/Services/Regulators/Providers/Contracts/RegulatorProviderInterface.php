<?php

// The Contracts folder is used commonly used in Laravel for interfaces and abstract classes.
// This could also be just named Interfaces

namespace App\Services\Regulators\Providers\Contracts;

use App\Models\Harvest;
use App\Models\Sale;

interface RegulatorProviderInterface
{
    // While in the current implementation of the providers, these do not change, if we wanted any custom logic in the future, we could add it in these methods.
    public function syncHarvested(Harvest $harvest): array; // Return array for testing

    public function syncSale(Sale $sale): array; // Return array for testing
}
