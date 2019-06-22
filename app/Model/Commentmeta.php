<?php

namespace App\Model;

class Commentmeta extends ModelBase
{
    protected $table = 'commentmeta';

    public $meta_id;

    public $comment_id;

    public $meta_key;

    public $meta_value;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();
    }
}
