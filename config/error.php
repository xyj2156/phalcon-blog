<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 20:49
 */

return [
    'logger'     => base_path('runtime', 'logs', 'error.log'),
    'formatter'  => [
        'format' => env('LOGGER_FORMAT', '[%date%][%type%] %message%'),
        'date'   => 'd-M-Y H:i:s',
    ],
    'controller' => 'error',
    'action'     => 'route500',
];