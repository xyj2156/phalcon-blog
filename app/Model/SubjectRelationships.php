<?php

namespace App\Model;

class SubjectRelationships extends ModelBase
{
    protected $table = 'subject_relationships';

    public $object_id;

    public $subject_id;

    public $order_num;

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        parent::initialize();

        $this->belongsTo(
            "subject_id",
            Subjects::class,
            "subject_id",
            [
                "alias" => "Subject",
            ]
        );

        $this->belongsTo(
            "object_id",
            Posts::class,
            "ID",
            [
                "alias" => "Post",
            ]
        );
    }

    public function afterCreate ()
    {
        /**
         * 创建后更新专题的统计数据和更新时间
         */
        $subject = $this->Subject;
        if ($subject) {
            $subject->updateNewStatus();
        }
    }

    public function afterDelete ()
    {
        /**
         * 删除后更新专题的统计数据
         */
        $subject = $this->Subject;
        if ($subject) {
            $subject->updateDeleteStatus();
        }
    }
}