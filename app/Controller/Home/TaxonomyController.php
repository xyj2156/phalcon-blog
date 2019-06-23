<?php

namespace App\Controller\Home;

use App\Library\Paginator\Pager;
use App\Model\Posts;
use App\Model\TermRelationships;
use App\Model\Terms;
use App\Model\TermTaxonomy;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class TaxonomyController extends HomeBase
{
    public function initialize ()
    {
        parent::initialize();

        $this->view->setTemplateAfter("common");
    }

    /**
     * 根据taxonomy获取post列表
     *
     * @param  string  $param
     */
    public function listAction ($param = '')
    {
        $type = $this->dispatcher->getParam("type");
        $nowPage = $this->request->getQuery('page', 'int', 1);

        if ($param != '' && !$this->view->getCache()->exists('taxonomy-'.$type.'-'.$param.'-page-'.$nowPage)) {

            if ($param) {

                /**
                 * sql for post list
                 */
                $builder = $this
                    ->modelsManager
                    ->createBuilder()
                    ->from(['p' => Posts::class])
                    ->groupBy("p.ID")
                    ->join(TermRelationships::class, 'tr.object_id = p.ID', 'tr')
                    ->join(TermTaxonomy::class, "tt.term_taxonomy_id = tr.term_taxonomy_id AND tt.taxonomy = :type:",
                        "tt")
                    ->join(Terms::class, 't.term_id = tt.term_id', "t")
                    ->columns([
                        'p.ID as post_id',
                        'p.post_date as post_date',
                        'p.post_html_content as post_content',
                        'p.post_title as post_title',
                        'p.guid as post_url',
                        'p.cover_picture as cover_picture',
                        'p.comment_count',
                        'p.view_count',
                        't.name as taxonomy_name',
                    ])
                    ->where("p.post_status = 'publish' AND p.post_type = 'post' AND t.slug = :slug: AND tt.taxonomy = :type: ",
                        ['slug' => $param, 'type' => $type])
                    ->orderBy('p.post_date DESC');

                /**
                 * get data page
                 * 数据做分页
                 */
                $pager = new Pager(
                    new PaginatorQueryBuilder(
                        [
                            'builder' => $builder,
                            'limit'   => $this->option->get('posts_per_page'),
                            'page'    => $nowPage,
                        ]
                    ),
                    [
                        'layoutClass' => Pager\Layout\Bootstrap::class, // 样式类
                        'rangeLength' => 6, // 分页长度
                        'urlMask'     => '?page={%page_number}', // 额外url传参
                    ]
                );

                // if current page over total page when total item is more than 0
                $totalPages = $pager->getTotalPage();
                $totalItems = $pager->count();
                if ($totalItems != 0) {
                    if ($nowPage > $totalPages) {
                        $this->dispatcher->forward(
                            [
                                "controller" => "error",
                                "action"     => "route404",
                            ]
                        );
                        return;
                    }
                }


                // the post list
                $postList = $pager->getIterator();

                /**
                 * get categories and tags
                 */
                $taxonomy = [];
                if (!empty($postList)) {
                    foreach ($postList as $post) {
                        $taxonomy[$post['post_id']] = $this->getTaxonomy($post['post_id']);
                    }
                }

                //set title
                $preTitle = isset($postList[0]['taxonomy_name']) ? $postList[0]['taxonomy_name'] : $param;
                if ($type == 'category') {
                    $this->tag->prependTitle($preTitle.' - 分类'." - ");
                } elseif ($type == 'tag') {
                    $this->tag->prependTitle($preTitle.' - 标签'." - ");
                } else {
                    $this->tag->prependTitle($preTitle." - ");
                }


                /**
                 * get page output
                 */
                if ($pager->haveToPaginate()) {
                    $page = $pager->getLayout();
                    $this->view->setVar('page', $page);
                }

                /**
                 * set values
                 */
                $this->view->setVars([
                    'posts'    => $postList,
                    'taxonomy' => $taxonomy,
                ]);

            } else {
                $this->dispatcher->forward(
                    [
                        'controller' => 'error',
                        'action'     => 'route404',
                    ]
                );
            }
        }

        $this->view->cache(
            [
                'key' => 'taxonomy-'.$type.'-'.$param.'-page-'.$nowPage,
            ]
        );
    }

    /**
     * 根据postId获取taxonomy
     *
     * @param $id
     *
     * @return array
     */
    protected function getTaxonomy ($id)
    {
        $taxonomy = $this->modelsManager->createBuilder()
                                        ->columns("tr.term_taxonomy_id, tt.taxonomy, t.name, t.slug")
                                        ->from(['tr' => TermRelationships::class])
                                        ->leftJoin(TermTaxonomy::class,
                                            'tt.term_taxonomy_id = tr.term_taxonomy_id', "tt")
                                        ->leftJoin(Terms::class, 't.term_id = tt.term_id', "t")
                                        ->where("tr.object_id = :id:", ["id" => $id])
                                        ->getQuery()
                                        ->execute();
//        $taxonomy = empty($taxonomy) ?: $taxonomy->toArray();

        $output = [];
        foreach ($taxonomy as $item) {
            if ($item['taxonomy'] == 'category' || $item['taxonomy'] == 'tag') {
                $output[$item['taxonomy']][] = $item;
            }
        }
        return $output;
    }
}