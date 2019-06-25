<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 20:51
 */
return [
    'default' => env('DEFAULT_CACHE_DRIVER', 'file'),

    'views' => env('VIEW_CACHE_DRIVER', 'views'),

    'drivers' => [
        'file' => [
            'adapter'  => 'File',
            'cacheDir' => cache_path('data').DIRECTORY_SEPARATOR,
        ],

        'views' => [
            'adapter'  => 'File',
            'cacheDir' => cache_path('views').DIRECTORY_SEPARATOR,
        ],

        'redis' => [
            'adapter'    => 'Redis',
            'host'       => env('REDIS_HOST', '127.0.0.1'), // 如用docker,对应redis的hostname
            'port'       => env('REDIS_PORT', 6379),
            'index'      => env('REDIS_INDEX', 0),
            'auth'       => env('REDIS_AUTH', ''),
            'persistent' => true,
        ],
    ],

    'prefix' => env('CACHE_PREFIX', '_jason_cache_'),

    'lifetime' => env('CACHE_LIFETIME', 86400),
];