<?php

namespace App\Model;

class Terms extends ModelBase
{
    protected $table = 'terms';

    public $term_id;

    public $name;

    public $slug;

    public $term_group;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->hasOne(
            "term_id",
            TermTaxonomy::class,
            "term_id"
        );
    }

    /**
     * 返回关联的TermTaxonomy表
     *
     * @param  null  $parameters
     *
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function getTermTaxonomy ($parameters = null)
    {
        return $this->getRelated(TermTaxonomy::class, $parameters);
    }
}
