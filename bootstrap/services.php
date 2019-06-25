<?php
/**
 * 服务注册阶段
 * 2019年6月21日 14:45:30
 */


// 用于展示总体执行时间
header_register_callback(function () {
//    日志事务提交
    container('logger')->commit();

    if (env('APP_DEBUG')) {
        $cache = base_path('runtime', 'cache');
        `rm -rf $cache`;
    }

    foreach ([
                 'X-Powered-By',
                 'Server',
             ] as $item) {
        $_item = 'HEADER_'.strtoupper($item);
        $val = env($_item, null);
        $val && header("{$item}: {$val}");
    }
    $total = microtime(true) - START_TIME;
    header('X-Exec-Time:'.$total);
});

/** @noinspection PhpIncludeInspection */
$services = include config_path('services.php');

foreach ($services as $class) {
    /** @var $class App\Providers\ServiceProvider\AbstractServiceProvider */
    $class::handle($di, null);
    unset($class);
}

