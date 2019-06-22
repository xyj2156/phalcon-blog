<?php

namespace App\Controller\Admin;


class IndexController extends AdminBase
{
    public function initialize ()
    {
        parent::initialize();
    }

    public function indexAction ()
    {
        $this->tag->prependTitle("仪表盘 - ");

        $this->view->setTemplateBefore("common");
    }
}

