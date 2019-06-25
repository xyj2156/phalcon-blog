<?php

/*
 +------------------------------------------------------------------------+
 | ZPhal                                                                  |
 +------------------------------------------------------------------------+
 | Copyright (c) 2017 ZPhal Team and contributors                         |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file docs/LICENSE.txt.                        |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to gzp@goozp.com so we can send you a copy immediately.                |
 +------------------------------------------------------------------------+
*/

use Phalcon\Di;
use Phalcon\DiInterface;

defined('BASE_PATH') or define('BASE_PATH', dirname(dirname(__DIR__)));

if (!function_exists('value')) {
    /**
     * 获取默认值Return the default value of the given value.
     *
     * @param  mixed  $value
     *
     * @return mixed
     */
    function value ($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * 获取环境变量值
     *
     * @param  string  $key
     * @param  mixed  $default
     *
     * @return mixed
     */
    function env ($key, $default = null)
    {
        $value = getenv($key);
        if (!empty($_ENV) && isset($_ENV[$key])) {
            $value = $_ENV[$key];
        }

        if ($value === false) {
            return value($default);
        }
        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }
        return $value;
    }
}


if (!function_exists('container')) {
    /**
     * 唤醒默认依赖注入容器
     *
     * @param  mixed
     *
     * @return mixed|DiInterface
     */
    function container ()
    {
        $default = Di::getDefault();

        if (!$default) {
            trigger_error('无法解析依赖项注入容器，可能是前面没有进行实例化过。', E_USER_ERROR);
        }

        $args = func_get_args();

        if (empty($args)) {
            return $default;
        }

        return call_user_func_array([$default, 'getShared'], $args);
    }
}

if (!function_exists('environment')) {
    /**
     * 检查当前的应用部署环境
     *
     * @param  mixed
     *
     * @return string|bool
     */
    function environment ()
    {
        if (func_num_args() > 0) {
            return call_user_func_array([container(), 'getEnvironment'], func_get_args());
        }

        return container()->getEnvironment();
    }
}

if (!function_exists('get_or_create_path')) {
    /**
     * 获取应用路径
     * Get the application path.
     *
     * @return string
     */
    function get_or_create_path ()
    {
        $params = func_get_args();
        $make = $path = implode(DIRECTORY_SEPARATOR, $params);
        $_info = pathinfo($path);
        if (!empty($_info['extension'])) {
            $make = $_info['dirname'];
        }
        if (!file_exists($make)) {
            @mkdir($make, 0777, true);
        }
        return $path;
    }
}

if (!function_exists('base_path')) {
    /**
     * 获取应用路径
     * Get the application path.
     *
     * @param  string  $path
     *
     * @return string
     */
    function base_path ($path = '')
    {
        $params = func_get_args();
        array_unshift($params, BASE_PATH);
        return call_user_func_array('get_or_create_path', $params);
    }
}

if (!function_exists('app_path')) {
    /**
     * 获取应用路径
     * Get the application path.
     *
     * @param  string  $path
     *
     * @return string
     */
    function app_path ($path = '')
    {
        $params = func_get_args();
        array_unshift($params, base_path('app'));
        return call_user_func_array('get_or_create_path', $params);
    }
}

if (!function_exists('cache_path')) {
    /**
     * 获取缓存路径
     * Get the cache path.
     *
     * @param  string  $path
     *
     * @return string
     */
    function cache_path ($path = '')
    {
        $params = func_get_args();
        array_unshift($params, base_path('runtime', 'cache'));
        return call_user_func_array('get_or_create_path', $params);
    }
}

if (!function_exists('config_path')) {
    /**
     * 获取配置路径
     * Get the configuration path.
     *
     * @param  string  $path
     *
     * @return string
     */
    function config_path ($path = '')
    {
        $params = func_get_args();
        array_unshift($params, base_path('config'));
        return call_user_func_array('get_or_create_path', $params);
    }
}