<?php

namespace App\Services\Regulators;

use App\Services\Regulators\Providers\BioTrackProvider;
use App\Services\Regulators\Providers\CCRSProvider;
use App\Services\Regulators\Providers\Contracts\RegulatorProviderInterface;
use App\Services\Regulators\Providers\MetrcProvider;
use Exception;
use InvalidArgumentException;

class RegulatorProviderFactory
{
    /**
     * Create a new provider instance based on the state
     *
     * @param string $state
     *
     * @return RegulatorProviderInterface
     * @throws Exception
     */
    public static function createProvider(string $state): RegulatorProviderInterface
    {
        $stateConfig = config('regulators.states.'.$state);

        if (! $stateConfig) {
            throw new InvalidArgumentException('State: '.$state.' is not supported.');
        }

        switch ($stateConfig['provider']) {
            case 'ccrs':
                return new CCRSProvider($state);
            case 'bio-track':
                return new BioTrackProvider($state);
            case 'metrc':
                return new MetrcProvider($state);
            default:
                throw new Exception('Unsupported provider: '.$stateConfig['provider']);
        }
    }
}
