<?php

return [
    'file_extension' => 'twig',
    'options' => [
        'debug' => Config::get('app.debug'),
        'charset' => 'utf-8',
        'cache' => storage_path('twig'),
        'auto_reload' => true,
        'strict_variables' => false,
        'autoescape' => false,
        'optimizations' => -1,
    ],
    'functions' => [
        'action',
        'app',
        'asset',
        'csrf_token',
        'link_to',
        'link_to_asset',
        'link_to_route',
        'link_to_action',
        'route',
        'secure_asset',
        'secure_url',
        'trans',
        'trans_choice',
        'url',
    ],
];
