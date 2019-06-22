<?php

namespace App\Plugin;

use Phalcon\Events\Event;

class AliYunOss
{
    public function beforeUploadMedia (Event $event, $myComponent, $file)
    {
        return false;
    }

    public function afterUploadMedia (Event $event, $myComponent, $file)
    {
        return false;
    }
}