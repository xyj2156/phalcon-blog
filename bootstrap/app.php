<?php
/**
 * 生成应用实例
 * 2019年6月21日 14:46:08
 *
 * @author jason
 */

require BOOT_PATH.'/loader.php';

$di = new \Phalcon\Di\FactoryDefault();

require BOOT_PATH.'/services.php';

$app = new \Phalcon\Mvc\Application($di);

return $app;