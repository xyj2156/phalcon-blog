<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/22
 * Time: 14:51
 */

use Phalcon\Mvc\Router;

/** @var $router Router */
/**
 * 后台路由
 */

$router->add('/admin', [
    'namespace'  => 'App\Controller\Admin',
    'controller' => 'index',
    'action'     => 'index',
])->setName('admin-root');

$admin = new Router\Group([
    'namespace' => 'App\Controller\Admin',
]);

$admin->setPrefix('/admin/');

$admin->add('session/login', [
    'controller' => 'session',
    'action'     => 'login',
])->setName('test.test');


$admin->add('session/logout', 'session::logout')->setName('admin-logout');

/* subject */
$admin->add('subject', 'subject::index')->setName('list-subject');

$admin->add('subject/new', 'subject::new')->setName('new-subject');

$admin->add('subject/save', 'subject::save')->setName('save-subject');

$admin->add('subject/edit/{id:[0-9]+}', [
    'controller' => 'subject',
    'action'     => 'edit',
    'id'         => 1,
])->setName('edit-subject');

$admin->add('subject/update/{id:[0-9]+}', [
    'controller' => 'subject',
    'action'     => 'update',
    'id'         => 1,
])->setName('update-subject');

$admin->add('subject/delete/{id:[0-9]+}', [
    'controller' => 'subject',
    'action'     => 'delete',
    'id'         => 1,
])->setName('delete-subject');

/* post */
$admin->add('post/:params', [
    'controller' => 'post',
    'action'     => 'index',
    'params'     => 1,
])->setName('list-article');

$admin->add('post/new', 'post::new')->setName('post.create');

$admin->add('post/save', 'post::save')->setName('post.store');

$admin->add('post/autodraft', 'post::autoSaveDraft');

$admin->add('post/edit/{id:[0-9]+}', [
    'controller' => 'post',
    'action'     => 'edit',
    'id'         => 1,
])->setName('edit-post');

$admin->add('post/update', 'post::update')->setName('update-post');

$admin->add('post/trash/{id:[0-9]+}', [
    'controller' => 'post',
    'action'     => 'trash',
    'id'         => 1,
])->setName('trash-post');

$admin->add('post/restore/{id:[0-9]+}', [
    'controller' => 'post',
    'action'     => 'restore',
    'id'         => 1,
])->setName('restore-post');

$admin->add('post/delete/{id:[0-9]+}', [
    'controller' => 'post',
    'action'     => 'delete',
    'id'         => 1,
])->setName('delete-post');

/* taxonomy */
$admin->add('taxonomy/{type:[a-zA-Z]+}', [
    'controller' => 'taxonomy',
    'action'     => 'taxonomy',
    'type'       => 1,
])->setName('taxonomy.taxonomy');

$admin->add('taxonomy/quickAddTaxonomy/{type:[a-zA-Z]+}', [
    'controller' => 'taxonomy',
    'action'     => 'quickAddTaxonomy',
    'type'       => 1,
])->setName('taxonomy.quickAddTaxonomy');

$admin->add('taxonomy/addTaxonomy/{type:[a-zA-Z]+}', [
    'controller' => 'taxonomy',
    'action'     => 'addTaxonomy',
    'type'       => 1,
])->setName('new-taxonomy');

$admin->add('taxonomy/editTaxonomy/{type:[a-zA-Z]+}/{id:[0-9]+}', [
    'controller' => 'taxonomy',
    'action'     => 'editTaxonomy',
    'type'       => 1,
    'id'         => 2,
])->setName('edit-taxonomy');

$admin->add('taxonomy/updateTaxonomy/{type:[a-zA-Z]+}/{id:[0-9]+}', [
    'controller' => 'taxonomy',
    'action'     => 'updateTaxonomy',
    'type'       => 1,
    'id'         => 2,
])->setName('update-taxonomy');

$admin->add('taxonomy/deleteTaxonomy/{type:[a-zA-Z]+}/{id:[0-9]+}', [
    'controller' => 'taxonomy',
    'action'     => 'deleteTaxonomy',
    'type'       => 1,
    'id'         => 2,
])->setName('delete-taxonomy');

/* page */
$admin->add('page/:params', [
    'controller' => 'page',
    'action'     => 'index',
    'params'     => 1,
])->setName('list-page');

$admin->add('page/new', 'page::new')->setName('new-page');

$admin->add('page/save', 'page::save')->setName('save-page');

$admin->add('page/autodraft', 'page::autoSaveDraft');

$admin->add('page/edit/{id:[0-9]+}', [
    'controller' => 'page',
    'action'     => 'edit',
    'id'         => 1,
])->setName('edit-page');

$admin->add('page/update', 'page::update')->setName('update-page');

$admin->add('page/trash/{id:[0-9]+}', [
    'controller' => 'page',
    'action'     => 'trash',
    'id'         => 1,
])->setName('trash-page');

$admin->add('page/restore/{id:[0-9]+}', [
    'controller' => 'page',
    'action'     => 'restore',
    'id'         => 1,
])->setName('restore-page');

$admin->add('page/delete/{id:[0-9]+}', [
    'controller' => 'page',
    'action'     => 'delete',
    'id'         => 1,
])->setName('delete-page');

/* media */
$admin->add('media', 'media::index')->setName('media.index');

$admin->add('media/new', 'media::new')->setName('media.create');

$admin->add('media/upload', 'media::upload')->setName('media.upload');

/* links */
$admin->add('link', 'link::index')->setName('list-link');

$admin->add('link/new', 'link::new')->setName('link.create');

$admin->add('link/save', 'link::save')->setName('link.store');

$admin->add('link/edit/{id:[0-9]+}', [
    'controller' => 'link',
    'action'     => 'edit',
    'id'         => 1,
])->setName('edit-link');

$admin->add('link/update/{id:[0-9]+}', [
    'controller' => 'link',
    'action'     => 'update',
    'id'         => 1,
])->setName('update-link');

$admin->add('link/delete/{id:[0-9]+}', [
    'controller' => 'link',
    'action'     => 'delete',
    'id'         => 1,
])->setName('delete-link');

/* user */
$admin->add('user', 'user::index')->setName('user.index');

$admin->add('user/new', 'user::new')->setName('user.create');

$admin->add('user/save', 'user::save')->setName('user.store');

$admin->add('user/self', 'user::self')->setName('user.self');

$admin->add('user/updateInfo', 'user::updateInfo')->setName('user.updateInfo');

$admin->add('user/updatePassword', 'user::updatePassword')->setName('user.updatePassword');

/* setting */
$admin->add('setting/general', 'setting::general')->setName('setting.general');

$admin->add('setting/saveGeneral', 'setting::saveGeneral')->setName('setting.saveGeneral');

$admin->add('setting/property', 'setting::property')->setName('setting.property');

$admin->add('setting/saveProperty', 'setting::saveProperty')->setName('setting.saveProperty');

$admin->add('setting/writing', 'setting::writing')->setName('setting.writing');

$admin->add('setting/saveWriting', 'setting::saveWriting')->setName('setting.saveWriting');

$admin->add('setting/reading', 'setting::reading')->setName('setting.reading');

$admin->add('setting/saveReading', 'setting::saveReading')->setName('setting.saveReading');

$admin->add('setting/discuss', 'setting::discuss')->setName('setting.discuss');

$admin->add('setting/saveDiscuss', [
    'controller' => 'setting',
    'action'     => 'saveDiscuss',
])->setName('setting.saveDiscuss');

$admin->add('setting/media', [
    'controller' => 'setting',
    'action'     => 'media',
])->setName('setting.media');

$admin->add('setting/saveMedia', [
    'controller' => 'setting',
    'action'     => 'saveMedia',
])->setName('setting.saveMedia');

$admin->add('setting/permalink', [
    'controller' => 'setting',
    'action'     => 'permalink',
])->setName('setting.permalink');

$admin->add('setting/savePermalink', [
    'controller' => 'setting',
    'action'     => 'savePermalink',
])->setName('setting.savePermalink');

$admin->add('setting/project', [
    'controller' => 'setting',
    'action'     => 'project',
])->setName('setting.project');

$admin->add('setting/saveProject', [
    'controller' => 'setting',
    'action'     => 'saveProject',
])->setName('setting.saveProject');

$admin->add('setting/saveShowRepo', [
    'controller' => 'setting',
    'action'     => 'saveShowRepo',
])->setName('setting.saveShowRepo');


$router->mount($admin);
