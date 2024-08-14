<?php

namespace App\Services\Regulators\Providers;

use App\Services\Regulators\Providers\Contracts\BaseProvider;
use App\Services\Regulators\Providers\Contracts\RegulatorProviderInterface;

// While the class is empty, it is still required to be defined in case we wanted to override any methods or add custom functionality in the future.
class CCRSProvider extends BaseProvider implements RegulatorProviderInterface {}
