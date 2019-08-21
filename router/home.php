<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/22
 * Time: 14:50
 */

use Phalcon\Mvc\Router;

/** @var $router Router */

/**
 * 前台路由
 * */
$router->add('/', [
    'controller' => 'index',
    'action'     => 'index',
])->setName('index');

$router->add('/category/:params', [
    'controller' => 'taxonomy',
    'action'     => 'list',
    'type'       => 'category',
    'params'     => 1,
])->setName('index-category');

$router->add('/tag/:params', [
    'controller' => 'taxonomy',
    'action'     => 'list',
    'type'       => 'tag',
    'params'     => 1,
])->setName('index-tag');

$router->add("/{param:[a-zA-Z_-]+}", [
    'controller' => 'pages',
    'action'     => 'index',
    "param"      => 1,
])->setName('page');

$router->add('/article', [
    'controller' => 'index',
    'action'     => 'article',
])->setName('index-article');

$router->add("/article/{id:[0-9]+}", [
    'controller' => 'articles',
    'action'     => 'index',
    "id"         => 1,
])->setName('article');

$router->add("/alias/{slug:[\w]+}", [
    'controller' => 'articles',
    'action'     => 'slug',
    "slug"       => 1,
])->setName('article');

$router->add("/subject/:params", [
    'controller' => 'subjects',
    'action'     => 'subject',
    "params"     => 1,
])->setName('subject');

$router->add("/subject/item/:params", [
    'controller' => 'subjects',
    'action'     => 'detail',
    "params"     => 1,
])->setName('subject-detail');

$router->add("/archive", [
    'controller' => 'archives',
    'action'     => 'index',
])->setName('archive');

$router->add("/project", [
    'controller' => 'projects',
    'action'     => 'index',
])->setName('project');

$router->add("/link", [
    'controller' => 'links',
    'action'     => 'index',
])->setName('link');

$router->add('/login', [
    'namespace'  => 'App\Controller\Admin',
    'controller' => 'login',
    'action'     => 'index',
])->setName('admin-login');

$router->add('/register', [
    'namespace'  => 'App\Controller\Admin',
    'controller' => 'login',
    'action'     => 'register',
])->setName('admin-login');

$router->add('/search', 'index::search');

