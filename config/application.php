<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 20:46
 */

defined('THEMES_PATH') or define('THEMES_PATH', base_path('public', 'themes'));

return [
    'appDir'        => app_path(),
    'modelsDir'     => app_path('Model'),
    'migrationsDir' => app_path('migrations'),
    'cacheDir'      => cache_path(),
    'themesDir'     => THEMES_PATH.DS, // 主题目录
    'uploadDir'     => base_path('public', 'uploads'),

    // 动态URI动态写法(不支持nginx配置public下为根目录):
    // 'baseUri'        => preg_replace('/([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    // 动态URI静态写法(需设置host或配置域名, 否则为/zPhal/等其它情况) :
    'baseUri'       => '/',
];