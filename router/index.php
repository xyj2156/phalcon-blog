<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:15
 */

use Phalcon\Mvc\Router;

/** @var  $router Router */
$router->setUriSource($router::URI_SOURCE_SERVER_REQUEST_URI);

// 去除末尾的 /
$router->removeExtraSlashes(true);

$router->setDefaults([
    'namespace'  => 'App\Controller\Home',
    'controller' => 'index',
    'index'      => 'index',
    'params'     => [],
]);

/** @noinspection PhpIncludeInspection */
include base_path('router', 'home.php');
/** @noinspection PhpIncludeInspection */
include base_path('router', 'admin.php');


//$router->addGet('/404', 'Error::route404')->setName('error-404');

$router->notFound([
    'controller' => 'error',
    'action'     => 'route404',
]);

return $router;