<?php

return [

    'publicId' => env('CLOUDPAYMENTS_PUBLIC_ID', 'pk_000'),
    'apiPassword' => env('CLOUDPAYMENTS_API_PASSWORD', '123'),

    // 1 — Упрощенная система налогообложения (Доход)
    'taxationSystem' => env('CLOUDPAYMENTS_TAXATION_SYSTEM', null),

];
