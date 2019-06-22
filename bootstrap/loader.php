<?php
/**
 * 项目初始化 加载文件专用
 *
 * @date 2019年6月21日 14:45:42
 * @author jason
 */

use Phalcon\Debug;
use Phalcon\Loader;

//剔除指定后缀
$tmp = [];
$tmp['_src_url'] = $_SERVER['REQUEST_URI'];
$_tmp['_parse_url'] = parse_url($tmp['_src_url']);
$_tmp['_path_info'] = pathinfo($_tmp['_parse_url']['path']);
if (
    !empty($_tmp['_path_info']['extension'])
    && in_array(
        $_tmp['_path_info']['extension'],
        ['html', 'shtml', 'jsp', 'asp', 'jspx', 'aspx']
    )) {
    $_tmp['_path_info']['dirname'] === '/' && ($_tmp['_path_info']['dirname'] = '');
    $_tmp['_url'] = "{$_tmp['_path_info']['dirname']}/{$_tmp['_path_info']['filename']}";
    $_SERVER['REQUEST_URI'] = $_tmp['_url'];
    empty($_tmp['_parse_url']['query']) or $_SERVER['REQUEST_URI'] .= '?'.$_tmp['_parse_url']['query'];
}
unset($tmp);

$_composer = BASE_PATH.'/vendor/autoload.php';
if (!file_exists($_composer) or !is_readable($_composer)) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new \Phalcon\Exception('无法加载 composer 文件，请确认是否执行了 composer install');
}

/** @noinspection PhpIncludeInspection */
include $_composer;

// 加载 .env 文件
try {
    $dot = new \Dotenv\Dotenv(BASE_PATH);
    $dot->load();
} catch (\Dotenv\Exception\ExceptionInterface $exception) {

}

// 使用 phalcon 自带的 debug 工具
$debugger = new Debug();
$debugger->listen();


/**
 * 我使用命名空间隔离模块
 * 减少模块切换的思路打断
 *
 * @date 2019年6月21日 14:48:49
 *
 * @author jason
 */
$loader = new Loader();
$loader->registerNamespaces([
    'App' => APP_PATH,
]);
$loader->registerFiles([
    APP_PATH.'/helper/basic.php',
    APP_PATH.'/helper/functions.php',
]);
$loader->register();
