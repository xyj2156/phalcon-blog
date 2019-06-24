<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/23
 * Time: 21:41
 */
/**
 * 提供四种适配器 对应 phalcon 框架自带的四种适配器
 * 格式化适配器 Line Syslog Json
 */
return [
    'default'   => env('LOGGER_TYPE', 'file'),
    'formatter' => env('LOGGER_FORMATTER', 'line'),
    'device'    => [
        'file'   => [
            'adapter'   => 'File',
            'path'      => base_path('runtime', 'logs', 'file'),
            'file'      => 'Ymd',
            'extension' => '.log',
        ],
        'syslog' => [
            'adapter'   => 'Syslog',
            'path'      => base_path('runtime', 'logs', 'line'),
            'file'      => 'Ymd',
            'extension' => '.log',
        ],
        'stream' => [
            'adapter'   => 'Stream',
            'path'      => base_path('runtime', 'logs', 'line'),
            'file'      => 'Ymd',
            'extension' => '.log',
        ],
        'line'   => [
            'format'      => '[%date%][%type%] %message%',
            'date_format' => 'Y-m-d H:i:s',
        ],
    ],
];