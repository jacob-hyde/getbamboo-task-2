<?php

// The Contracts folder is used commonly used in Laravel for interfaces and abstract classes.
// This also could go directly into the App\Services\Regulators namespace.

namespace App\Services\Regulators\Providers\Contracts;

use App\Models\Harvest;
use App\Models\Sale;
use Illuminate\Support\Facades\Config;

abstract class BaseProvider implements RegulatorProviderInterface
{
    /**
     * @var string The URL to the state's API
     */
    protected string $stateUrl;

    /**
     * @var array Custom field names to use than the default model field names
     */
    protected array $customFields = [];

    public function __construct(string $state)
    {
        $stateConfig = Config::get('regulators.states.'.$state); // Could use config helper instead of facade
        $providerKey = $stateConfig['provider'];
        $providerConfig = Config::get('regulators.providers.'.$providerKey);

        $this->stateUrl = $stateConfig['state_url'];

        // Merge provider default custom fields with state-specific overrides
        $this->customFields = array_merge(
            $providerConfig['override_model_field_names'] ?? [],
            $stateConfig['custom_fields'] ?? []
        );
    }

    /**
     * Sync harvested data with the state's API
     *
     * @param Harvest $harvest
     * @return array
     */
    public function syncHarvested(Harvest $harvest): array
    {
        return $this->postData('harvest', $harvest->only([
            'uuid',
            'strain',
            'quantity',
            'unit',
            'weight',
        ]));
    }

    /**
     * Sync sale data with the state's API
     *
     * @param Sale $sale
     * @return array
     */
    public function syncSale(Sale $sale): array
    {
        return $this->postData('sale', $sale->only([
            'uuid',
            'strain',
            'quantity',
            'unit',
            'weight',
        ]));
    }

    /**
     * Map custom field names to the model field names
     *
     * @param array $data
     * @return array
     */
    protected function mapCustomFields(array $data): array
    {
        foreach ($this->customFields as $key => $mappedKey) {
            if (isset($data[$key])) {
                $data[$mappedKey] = $data[$key];
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Post data to the state's API
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    protected function postData(string $endpoint, array $data): array
    {
        $data = $this->mapCustomFields($data);
        $fullUrl = $this->stateUrl.'/'.$endpoint;

        //Logic to post data to the API...for now we will just return an array
        return [
            'state_url' => $this->stateUrl,
            'endpoint' => $endpoint,
            'full_url' => $fullUrl,
            'data' => $data,
        ];
    }
}
