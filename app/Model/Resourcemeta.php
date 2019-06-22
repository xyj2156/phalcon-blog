<?php

namespace App\Model;

class Resourcemeta extends ModelBase
{
    protected $table = 'resourcemeta';

    public $meta_id;

    public $resource_id;

    public $meta_key;

    public $meta_value;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->belongsTo(
            "resource_id",
            Resources::class,
            "resource_id"
        );
    }
}
