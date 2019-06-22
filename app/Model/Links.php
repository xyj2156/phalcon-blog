<?php

namespace App\Model;

class Links extends ModelBase
{
    protected $table = 'links';

    public $link_id;

    public $link_url;

    public $link_name;

    public $link_image;

    public $link_target;

    public $link_description;

    public $link_visible;

    public $link_owner;

    public $link_rating;

    public $link_updated;

    public $link_rel;

    public $link_notes;

    public $link_rss;

    const VISIBLE_SHOW = 'Y';

    const VISIBLE_HIDE = 'N';


    /**
     * 插入新数据前
     */
    public function beforeCreate ()
    {
        $this->link_updated = date('Y-m-d H:i:s', time());
    }
}
