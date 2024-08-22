<?php

return [
    'base_url' => env('PHONEPE_BASE_URL', 'https://api.phonepe.com/apis/hermes'),
    'merchant_id' => env('PHONEPE_MERCHANT_ID'),
    'merchant_key' => env('PHONEPE_MERCHANT_KEY'),
    'salt_key' => env('PHONEPE_SALT_KEY'),
];