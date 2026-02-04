<?php

return [
    /*
        |--------------------------------------------------------------------------
        | Credenciales para busqueda en sunat y reniec
        |--------------------------------------------------------------------------
        */
    'search_apis_net' => [
        'base_url' => env('BASE_URL_APIS_NET'),
        'token' => env('TOKEN_APIS_NET'),
    ],

    /*
        |--------------------------------------------------------------------------
        | Credenciales para nubefact (emision de boletas o facturas)
        |--------------------------------------------------------------------------
        */
    'nubefact' => [
        'base_url' => env('NUBEFACT_URL'),
        'token' => env('NUBEFACT_TOKEN'),
        'serie_boleta' => env('NUBEFACT_SERIE_BOLETA'),
        'serie_factura' => env('NUBEFACT_SERIE_FACTURA'),
    ],
];
