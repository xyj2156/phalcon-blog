<?php
/**
 * 服务注册阶段
 * 2019年6月21日 14:45:30
 */


// 用于展示总体执行时间
header_register_callback(function () {
    $total = microtime(true) - START_TIME;
    header('X-Exec-Time:'.$total);
    foreach ([
                 'X-Powered-By',
                 'Server',
             ] as $item) {
        $_item = 'HEADER_'.strtoupper($item);
        $x_powered_by = env($_item, null);
        $x_powered_by && header("{$item}: {$x_powered_by}");
    }
});

/** @noinspection PhpIncludeInspection */
$services = include config_path('services.php');

foreach ($services as $class) {
    /** @var $class App\Providers\ServiceProvider\AbstractServiceProvider */
    $class::handle($di, null);
}
