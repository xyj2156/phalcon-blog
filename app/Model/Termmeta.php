<?php

namespace App\Model;

class Termmeta extends ModelBase
{
    protected $table = 'termmeta';

    public $meta_id;

    public $term_id;

    public $meta_key;

    public $meta_value;
}
