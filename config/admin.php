<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/24
 * Time: 17:37
 */

return [
    'menu' => [
        [
            'name' => '主菜单',
            'type' => 0,
        ],
        [
            'name'       => '仪表盘',
            'type'       => 2,
            'icon'       => 'fa-dashboard',
            'controller' => ['index'],
            'target'     => [
                [
                    'name'       => '首页',
                    'target'     => '/admin.html',
                    'action'     => 'index',
                    'controller' => 'index',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '文章',
            'type'       => 2,
            'icon'       => 'fa-files-o',
            'controller' => [
                'post',
                'taxonomy',
            ],
            '_type'      => [
                '',
                'category',
                'tag',
            ],
            'target'     => [
                [
                    'name'       => '所有文章',
                    'target'     => '/admin/post.html',
                    'controller' => 'post',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '写文章',
                    'target'     => '/admin/post/new.html',
                    'controller' => 'post',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '分类目录',
                    'target'     => '/admin/taxonomy/category.html',
                    'controller' => 'taxonomy',
                    'action'     => 'taxonomy',
                    'type'       => 'category',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '标签',
                    'target'     => '/admin/taxonomy/tag.html',
                    'controller' => 'taxonomy',
                    'action'     => 'taxonomy',
                    'type'       => 'tag',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '专题',
            'type'       => 2,
            'icon'       => 'fa-dashcube',
            'controller' => ['subject'],
            'target'     => [
                [
                    'name'       => '专题管理',
                    'target'     => 'admin/subject.html',
                    'controller' => 'subject',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '添加',
                    'target'     => '/admin/subject/new.html',
                    'controller' => 'subject',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '媒体',
            'type'       => 2,
            'icon'       => 'fa-medium',
            'controller' => [
                'media',
            ],
            'target'     => [
                [
                    'name'       => '媒体库',
                    'target'     => '/admin/media.html',
                    'controller' => 'media',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '上传资源',
                    'target'     => '/admin/media/new.html',
                    'controller' => 'media',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '连接',
            'type'       => 2,
            'icon'       => 'fa-link',
            'controller' => [
                'link',
                'taxonomy',
            ],
            '_type'      => [
                'linkCategory',
            ],
            'target'     => [
                [
                    'name'       => '全部连接',
                    'target'     => '/admin/link.html',
                    'controller' => 'link',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '添加',
                    'target'     => '/admin/link/new.html',
                    'controller' => 'link',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '链接分类目录',
                    'target'     => '/admin/taxonomy/linkCategory.html',
                    'controller' => 'taxonomy',
                    'action'     => 'taxonomy',
                    'type'       => 'linkCategory',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '页面',
            'type'       => 2,
            'controller' => ['page'],
            'icon'       => 'fa-sticky-note-o',
            'target'     => [
                [
                    'name'       => '所有页面',
                    'target'     => '/admin/page.html',
                    'controller' => 'page',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '新建页面',
                    'target'     => '/admin/page/new.html',
                    'controller' => 'page',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '评论',
            'type'       => 1,
            'icon'       => 'fa-comments-o',
            'target'     => '#',
            'controller' => ['comment'],
        ],
        [
            'name' => '功能',
            'type' => 0,
        ],
        [
            'name'       => '用户',
            'type'       => 2,
            'controller' => ['user'],
            'icon'       => 'fa-user',
            'target'     => [
                [
                    'name'       => '所有用户',
                    'target'     => '/admin/user.html',
                    'controller' => 'user',
                    'action'     => 'index',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '添加用户',
                    'target'     => '/admin/user/new.html',
                    'controller' => 'user',
                    'action'     => 'new',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '我的资料',
                    'target'     => '/admin/user/self.html',
                    'controller' => 'user',
                    'action'     => 'self',
                    'icon'       => 'fa-circle-o',
                ],
            ],
        ],
        [
            'name'       => '设置',
            'type'       => 2,
            'controller' => ['setting'],
            'icon'       => 'fa-cogs',
            'target'     => [
                [
                    'name'       => '常规',
                    'target'     => '/admin/setting/general.html',
                    'controller' => 'setting',
                    'action'     => 'general',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '网站属性',
                    'target'     => '/admin/setting/property.html',
                    'controller' => 'setting',
                    'action'     => 'property',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '撰写',
                    'target'     => '/admin/setting/writing.html',
                    'controller' => 'setting',
                    'action'     => 'writing',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '阅读',
                    'target'     => '/admin/setting/reading.html',
                    'controller' => 'setting',
                    'action'     => 'reading',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '讨论',
                    'target'     => '/admin/setting/discuss.html',
                    'controller' => 'setting',
                    'action'     => 'discuss',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '媒体',
                    'target'     => '/adnmin/setting/media.html',
                    'controller' => 'setting',
                    'action'     => 'media',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '固定连接',
                    'target'     => '/adnmin/setting/permalink.html',
                    'controller' => 'setting',
                    'action'     => 'permalink',
                    'icon'       => 'fa-circle-o',
                ],
                [
                    'name'       => '作品',
                    'target'     => '/adnmin/setting/project.html',
                    'controller' => 'setting',
                    'action'     => 'project',
                    'icon'       => 'fa-github',
                ],
            ],
        ],
        [
            'name' => '标签颜色',
            'type' => 0,
        ],
        [
            'name'       => '重要',
            'type'       => 1,
            'controller' => [],
            'icon'       => 'fa-circle-o text-red',
            'target'     => '#',
        ],
        [
            'name'       => '提醒',
            'type'       => 1,
            'controller' => [],
            'icon'       => 'fa-circle-o text-yellow',
            'target'     => '#',
        ],
        [
            'name'       => '信息',
            'type'       => 1,
            'controller' => [],
            'icon'       => 'fa-circle-o text-green',
            'target'     => '#',
        ],
    ],
];