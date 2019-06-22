<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 20:54
 */

return [
    'default' => env('SESSION_DRIVER', 'redis'),

    'drivers' => [
        'redis' => [
            'adapter'    => 'Redis',
            'host'       => env('REDIS_HOST', '127.0.0.1'),
            'port'       => env('REDIS_PORT', 6379),
            'index'      => env('REDIS_INDEX', 0),
            'persistent' => true,
        ],

        'file' => [
            'adapter' => 'Files',
        ],
    ],

    'prefix' => env('SESSION_PREFIX', '_jason_session_'),

    'uniqueId' => env('SESSION_UNIQUE_ID', 'json_cms_'),

    'lifetime' => env('SESSION_LIFETIME', 86400),
];