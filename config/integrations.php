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
        //Para ventas online (a4)
        'token_online' => env('NUBEFACT_TOKEN_ONLINE'),
        'serie_boleta_online' => env('NUBEFACT_SERIE_BOLETA_ONLINE'),
        'serie_factura_online' => env('NUBEFACT_SERIE_FACTURA_ONLINE'),
        //Para ventas en tienda (ticket)
        'token_store' => env('NUBEFACT_TOKEN_STORE'),
        'serie_boleta_store' => env('NUBEFACT_SERIE_BOLETA_STORE'),
        'serie_factura_store' => env('NUBEFACT_SERIE_FACTURA_STORE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Credenciales del Niubiz
    |--------------------------------------------------------------------------
    */
    'niubiz' => [
        'url_api' => env('NIUBIZ_URL_API'),
        'merchant_id' => env('NIUBIZ_MERCHANT_ID'),
        'user' => env('NIUBIZ_USER'),
        'password' => env('NIUBIZ_PASSWORD'),
    ]
];
