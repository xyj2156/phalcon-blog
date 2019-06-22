<?php

namespace App\Model;

class TermTaxonomy extends ModelBase
{
    protected $table = 'term_taxonomy';

    public $term_taxonomy_id;

    public $term_id;

    public $taxonomy;

    public $description;

    public $parent;

    public $count;

    const TAXONOMY_CATEGORY = 'category';

    const TAXONOMY_TAG = 'tag';

    const TAXONOMY_LINK = 'linkCategory';

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->belongsTo(
            "term_id",
            Terms::class,
            "term_id",
            [
                "alias" => "Terms",
            ]
        );

        $this->hasMany(
            "term_taxonomy_id",
            TermRelationships::class,
            "term_taxonomy_id",
            [
                'alias' => 'TermRelationships',
            ]
        );

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
     * 获取父id
     *
     * @return mixed
     */
    public function getParent ()
    {
        return $this->parent;
    }

    /**
     * 递归父ID
     *
     * @param  array  $allId
     * @param $id
     *
     * @return array
     */
    public function getAllParent ($allId = [], $id)
    {
        $parent = $id ? $id : $this->parent;
        if ($parent) {
            $allId[] = $parent;
            $parentInfo = self::findFirst($parent);
            if ($parentInfo->parent) {
                return $this->getAllParent($allId, $parentInfo->parent);
            }
        }
        return $allId;
    }

    /**
     * 清除缓存
     */
    public function clearCache ()
    {
        /**
         * 清除view缓存
         */
        $viewCache = $this->getDI()->getShared('viewCache');

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

        /**
         * 清除data缓存
         */
        $modelsCache = $this->getDI()->getShared('modelsCache');
        $modelsCache->delete('widget-taxonomy-category-list'); // widget
    }
}
