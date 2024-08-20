<?php

use Illuminate\Support\Str;

return [

    'token' => env('DADATA_TOKEN'),
    'secret' => env('DADATA_SECRET'),
    'timeout' => env('DADATA_TIMEOUT', 10),
];
