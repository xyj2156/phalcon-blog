<?php

namespace App\Controller\Home;

class LinksController extends HomeBase
{
    public function initialize ()
    {
        parent::initialize();

        $this->view->setTemplateAfter("link");
    }

    public function indexAction ()
    {
        $this->tag->prependTitle('链接'." - ");
    }

}