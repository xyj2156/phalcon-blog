<?php

namespace App\Model;

class Usermeta extends ModelBase
{
    protected $table = 'usermeta';

    public $umeta_id;

    public $user_id;

    public $meta_key;

    public $meta_value;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->belongsTo(
            "user_id",
            Users::class,
            "ID"
        );
    }
}
