<?php

return [
    'tmn_code' => env('VNPAY_TMN_CODE', 'N3CQCUFC'),
    'hash_secret' => env('VNPAY_HASH_SECRET', 'MUDLCBCDSCNOCDITZL16FD42AXH71TIQ'),
    'url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'return_url' => env('VNPAY_RETURN_URL', 'http://127.0.0.1:8000/payment/process/return'),
    'ipn_url' => env('VNPAY_IPN_URL', ''),
];