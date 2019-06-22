<?php

namespace App\Model;

class TermRelationships extends ModelBase
{
    protected $table = 'term_relationships';

    public $object_id;

    public $term_taxonomy_id;

    public $term_order;

    /**
     * 初始化
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->belongsTo(
            "term_taxonomy_id",
            TermTaxonomy::class,
            "term_taxonomy_id",
            [
                'alias' => 'TermTaxonomy',
            ]
        );

        $this->belongsTo(
            "object_id",
            Posts::class,
            "ID",
            [
                'alias' => 'Post',
            ]
        );
    }

    /**
     * 创建之后
     */
    public function afterCreate ()
    {
        /**
         * 更新所属分类和标签的数目
         */
        $termTaxonomy = $this->TermTaxonomy;
        if ($termTaxonomy) {
            $termTaxonomy->count++;
            $termTaxonomy->save();
        }

    }

    /**
     * 删除之后
     */
    public function afterDelete ()
    {
        /**
         * 更新所属分类和标签的数目
         */
        $termTaxonomy = $this->TermTaxonomy;
        if ($termTaxonomy) {
            $termTaxonomy->count--;
            $termTaxonomy->save();
        }
    }

}
