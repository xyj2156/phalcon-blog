<?php
/**
 * 应用统一入口
 * 2019年6月21日 14:46:37
 *
 * @author jason
 */

use Phalcon\Logger\Adapter;

define('START_TIME', microtime(true));
error_reporting(E_ALL); // testing use
date_default_timezone_set('PRC');

// 初始化常量
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH.'/app');
define('BOOT_PATH', BASE_PATH.'/bootstrap');
define('CONFIG_PATH', BASE_PATH.'/config');
define('PUBLIC_PATH', BASE_PATH.'/public');
define('RUNTIME_PATH', BASE_PATH.'/runtime');
define('DS', DIRECTORY_SEPARATOR);

try {
//获取 APP 实例
    /** @var Phalcon\Mvc\Application $app */
    $app = include BOOT_PATH.'/app.php';

// 获取响应对象
    $response = $app->handle();
//输出相应对象的内容
    echo $response->getContent();
} catch (Exception $exception) {
    if (env('APP_DEBUG')) {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw $exception;
    }
    header('location:/error/route500.html');
    try {
        /** @var Adapter $logger */
        $logger = container('logger');
        $logger->error($exception->getMessage());
        $logger->error($exception->getTraceAsString());
    } catch (Exception $exception) {
        echo $exception->getMessage();
        echo '<pre>', $exception->getTraceAsString(), '</pre>';
    }
}
