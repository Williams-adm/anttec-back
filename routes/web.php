<?php

use App\Jobs\RabbitTestJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rabbit-test', function () {
    RabbitTestJob::dispatch();
    return 'Job enviado a RabbitMQ';
});
