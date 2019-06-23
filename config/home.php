<?php
/**
 * 前台展示 相关配置
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/23
 * Time: 14:35
 */

return [
    'nav' => [
        [
            'name'   => '首页',
            'router' => [
                'for' => 'index',
            ],
            'icon'   => 'fa-home',
        ],
        [
            'name'   => '专题',
            'router' => [
                'for' => 'subject',
            ],
            'icon'   => 'fa-flask',
        ],
        [
            'name'   => '归档',
            'router' => ["for" => "archive"],
            'icon'   => 'fa-archive',
        ],
        [
            'name'   => '作品',
            'router' => ["for" => "project"],
            'icon'   => 'fa-github-alt',
        ],
        //        [
        //            'name'   => '工具',
        //            'router' => [],
        //            'icon'   => 'fa-fire',
        //        ],
        [
            'name'   => '友链',
            'router' => ["for" => "link"],
            'icon'   => 'fa-link',
        ],
        [
            'name'   => '关于',
            'router' => ["for" => "page", "param" => 'about-me'],
            'icon'   => 'fa-leaf',
        ],
    ],
];