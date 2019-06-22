<?php

namespace App\Model\Services\Service;

use App\Model\Links;
use App\Model\Services\AbstractService;
use App\Model\TermRelationships;
use App\Model\Terms;
use App\Model\TermTaxonomy;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use App\Library\Paginator\Pager;

/**
 * 链接服务类
 * Class LinkService
 *
 * @package App\Model\Services\Service
 */
class LinkService extends AbstractService
{
    /**
     * @var mixed|\Phalcon\DiInterface
     */
    private static $modelsManager;

    /**
     * PostService constructor.
     *
     * @param  null  $di
     */
    public function __construct ($di = null)
    {
        parent::__construct($di);
        self::$modelsManager = $this->di->get('modelsManager') ?: container('modelsManager');
    }

    /**
     * 获取链接列表
     * TODO 多用户根据权限获取
     */
    public function getLinkList ($currentPage, $condition)
    {
        $builder = self::$modelsManager->createBuilder()
                                       ->columns("l.link_id, l.link_name, l.link_url, l.link_visible, GROUP_CONCAT( t.name ) taxonomy")
                                       ->from(['l' => Links::class])
                                       ->leftJoin(TermRelationships::class, 'ts.object_id = l.link_id', 'ts')
                                       ->leftJoin(TermTaxonomy::class,
                                           'tt.term_taxonomy_id = ts.term_taxonomy_id', 'tt')
                                       ->leftJoin(Terms::class,
                                           "t.term_id = tt.term_id and tt.taxonomy = 'linkCategory'", 't');

        if ($condition['categorySelected']) {
            $builder->andWhere("tt.term_taxonomy_id = :categorySelected:",
                ["categorySelected" => $condition['categorySelected']]);
        }

        if (!empty($condition['search'])) {
            $builder->andWhere("l.link_name LIKE :name:", ["name" => "%".$condition['search']."%"]);
        }

        $builder->groupBy("l.link_id");
        $builder->orderBy('l.link_id desc');

        // 分页额外url传参
        $urlMask = '?page={%page_number}';
        foreach ($condition as $key => $value) {
            $urlMask .= '&'.$key.'='.$value;
        }

        // 分页查询
        return $pager = new Pager(
            new PaginatorQueryBuilder(
                [
                    'builder' => $builder,
                    'limit'   => 20,
                    'page'    => $currentPage,
                ]
            ),
            [
                'layoutClass' => Pager\Layout\Bootstrap::class, // 样式类
                'rangeLength' => 5, // 分页长度
                'urlMask'     => $urlMask, // 额外url传参
            ]
        );
    }
}