<?php

namespace App\Controller\Admin;

use App\Controller\ControllerBase;
use Phalcon\Mvc\View;

class LoginController extends ControllerBase
{
    public function initialize ()
    {
        $this->view->setViewsDir(app_path('views'));
        $this->tag->setTitle($this->option->get('blogname')." | Jason");
    }

    /**
     * 登录页面
     */
    public function indexAction ()
    {
        $this->tag->prependTitle("登录 - ");

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
    }

    public function loginAction ()
    {
        /*$this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );*/
//        echo 123;
    }

    public function registerAction ()
    {

    }

}

