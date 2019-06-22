<?php

namespace App\Model;

class Posts extends ModelBase
{
    protected $table = 'posts';

    public $ID;

    public $post_author;

    public $post_date;

    public $post_date_gmt;

    public $post_content;

    public $post_html_content;

    public $post_title;

    public $post_status;

    public $comment_status;

    public $post_name;

    public $post_modified;

    public $post_modified_gmt;

    public $post_parent;

    public $cover_picture;

    public $guid;

    public $post_type;

    public $comment_count;

    public $view_count;

    const PUBLISH_DEFAULT_TIME = '1000-01-01 00:00:00'; //默认发布时间

    const TYPE_ARTICLE = 'post';

    const TYPE_PAGE = 'page';

    const COMMENT_OPEN = 'open';

    const COMMENT_CLOSE = 'closed';

    const STATUS_PUBLISH = 'publish';

    const STATUS_DRAFT = 'draft';

    const STATUS_TRASH = 'trash';

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->hasMany(
            "ID",
            Postmeta::class,
            "post_id",
            [
                'alias' => 'PostMeta',
            ]
        );

        $this->hasManyToMany(
            "ID",
            TermRelationships::class,
            "object_id",
            "term_taxonomy_id",
            TermTaxonomy::class,
            "term_taxonomy_id",
            [
                'alias' => 'TermTaxonomy',
            ]
        );
    }

    /**
     * 插入新数据时验证前
     */
    public function beforeValidationOnCreate ()
    {
        if (!$this->post_date) {
            $this->post_date = self::PUBLISH_DEFAULT_TIME;
        }

        if (!$this->post_date_gmt) {
            $this->post_date_gmt = self::PUBLISH_DEFAULT_TIME;
        }

        if (!$this->post_name) {
            $this->post_name = '';
        }

        $this->comment_count = 0;
        $this->view_count = 0;
    }

    /**
     * 更新数据时验证前
     */
    public function beforeValidationOnUpdate ()
    {
        if (!$this->post_modified) {
            $this->post_modified = date('Y-m-d H:i:s', time());
        }

        if (!$this->post_modified_gmt) {
            $this->post_modified_gmt = gmdate('Y-m-d H:i:s', time());
        }

    }


    /**
     * 保存之后
     */
    public function afterSave ()
    {
        $this->clearCache();
    }

    /**
     * 删除之后
     */
    public function afterDelete ()
    {
        $this->clearCache();
    }

    /**
     * 生成url
     */
    public function generateUrl ()
    {
        $url = $this->getDI()->getShared('url');
        if ($this->post_type == self::TYPE_ARTICLE) {
            $this->guid = $url->get(['for' => 'article', 'id' => $this->ID]);
        } elseif ($this->post_type == self::TYPE_PAGE) {
            $this->guid = $url->get(['for' => 'page', 'id' => $this->ID]);
        }
        $this->save();
    }

    /**
     * 获取下一篇
     *
     * @return array|bool
     */
    public function getNextPublish ()
    {
        $last = self::findFirst(
            [
                "conditions" => "ID > :id: AND post_status='publish' AND post_type=:type: ",
                "columns"    => "ID, post_title, guid",
                "order"      => "post_date ASC",
                "bind"       => [
                    'id'   => $this->ID,
                    'type' => $this->post_type,
                ],
            ]
        );

        if ($last) {
            return $last->toArray();
        } else {
            return false;
        }
    }

    /**
     * 获取上一篇
     *
     * @return array|bool
     */
    public function getLastPublish ()
    {
        $next = self::findFirst(
            [
                "conditions" => "ID < :id: AND post_status='publish' AND post_type=:type: ",
                "columns"    => "ID, post_title, guid",
                "order"      => "post_date DESC",
                "bind"       => [
                    'id'   => $this->ID,
                    'type' => $this->post_type,
                ],
            ]
        );

        if ($next) {
            return $next->toArray();
        } else {
            return false;
        }
    }

    /**
     * 更新浏览量
     */
    public function updateView ($num = 0)
    {
        if ($num != 0) {
            $this->view_count = $this->view_count + $num;
        } else {
            $this->view_count++;
        }

        if ($this->update()) {
            return true;
        }

        return false;
    }

    /**
     * 清除缓存
     */
    public function clearCache ()
    {
        if ($this->ID) {

            $viewCache = $this->getDI()->getShared('viewCache'); // view 缓存
            $modelsCache = $this->getDI()->getShared('modelsCache');  // data 缓存

            if ($this->post_type == 'post') {

                $viewCache->delete('articles-'.$this->ID);
                $viewCache->delete('archives');

                $keys = $viewCache->queryKeys('index');
                if ($keys) {
                    foreach ($keys as $key) {
                        $viewCache->delete($key);
                    }
                }

                $keys = $viewCache->queryKeys('taxonomy');
                if ($keys) {
                    foreach ($keys as $key) {
                        $viewCache->delete($key);
                    }
                }

                $keys = $viewCache->queryKeys('subject');
                if ($keys) {
                    foreach ($keys as $key) {
                        $viewCache->delete($key);
                    }
                }

                $modelsCache->delete('widget-articles-new-list'); // widget
                $modelsCache->delete('article-'.$this->ID); // widget

            } elseif ($this->post_type == 'page') {

                $viewCache->delete('pages-'.$this->post_name);

                $modelsCache->delete('page-'.$this->post_name);
            }


        }
    }
}
