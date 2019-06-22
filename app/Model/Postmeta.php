<?php

namespace App\Model;

class Postmeta extends ModelBase
{
    protected $table = 'postmeta';

    public $meta_id;

    public $post_id;

    public $meta_key;

    public $meta_value;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();
        $this->belongsTo(
            "post_id",
            Posts::class,
            "ID"
        );
    }

}
