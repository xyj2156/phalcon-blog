<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 20:45
 */

return [
    'adapter'  => env('DB_ADAPTER', 'Mysql'),
    'host'     => env('DB_HOST', '127.0.0.1'), // 如用docker,对应数据库容器的hostname
    'dbname'   => env('DB_DATABASE', 'jason_blog'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', 'root'),
    'charset'  => env('DB_CHARSET', 'utf8'),
];