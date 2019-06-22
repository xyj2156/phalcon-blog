<?php

namespace App\Model;

class Comments extends ModelBase
{

    protected $table = 'comments';

    public $comment_id;

    public $comment_post_id;

    public $comment_author;

    public $comment_author_email;

    public $comment_author_url;

    public $comment_author_ip;

    public $comment_date;

    public $comment_date_gmt;

    public $comment_content;

    public $comment_approved;

    public $comment_agent;

    public $comment_parent;

    public $user_id;

    /**
     * 插入新数据前
     */
    public function beforeCreate ()
    {
        $this->comment_date = date('Y-m-d H:i:s', time());
        $this->comment_date_gmt = gmdate('Y-m-d H:i:s', time());
    }
}
