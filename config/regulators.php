<?php

return [
    // Some of these providers are empty.
    // The idea is if there is any non-state specific options, we could add them to each provider.
    // The Sale and Harvest models contain the data that is being synced to the state's API.
    // If the state has different names for the fields, we can override them in the state's configuration.
    'providers' => [
        'ccrs' => [],
        'bio-track' => [
            'override_model_field_names' => [],
        ],
        'metrc' => [],
    ],

    // NY and NM have different names of fields, so we set a default in the provider and then override it in the state.
    'states' => [
        'WA' => [
            'provider' => 'ccrs',
            'state_url' => env('WA_CCRS_URL', 'https://wa.ccrs.example.com'),
        ],
        'NY' => [ // NY will use the default custom fields from the provider
            'provider' => 'bio-track',
            'state_url' => env('NY_BIO_TRACK_URL', 'https://ny.biotrack.example.com'),
        ],
        'NM' => [ // NM will override the default custom fields from the provider
            'provider' => 'bio-track',
            'state_url' => env('NM_BIO_TRACK_URL', 'https://nm.biotrack.example.com'),
            'custom_fields' => [
                'weight' => 'weight_grams',
            ],
        ],
        'CA' => [
            'provider' => 'metrc',
            'state_url' => env('CA_METRC_URL', 'https://ca.metrc.example.com'),
        ],
    ],
];
