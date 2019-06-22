<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:28
 */

namespace App\Controller\Home;

use App\Controller\ControllerBase;

abstract class HomeBase extends ControllerBase
{

    public function initialize ()
    {
        parent::initialize();
        $this->view->setTemplateAfter("common");
        $this->tag->setTitle($this->option->get('blogname'));

        /**
         * widget for the template
         */
        $this->view->setVars([
            'widgetCategory'   => $this->widget->getCategoryList(),
            'widgetNewArticle' => $this->widget->getNewArticles([
                'ulClass' => 'fa-ul ml-4 mb-0',
                'before'  => '<i class="fa-li fa fa-angle-double-right"></i>',
            ]),
        ]);

//        前台展示相关的视图数据
        $this->view->setVars(
            [
                "blogname"        => $this->option->get('blogname'),
                "blogdescription" => $this->option->get('blogdescription'),
                "siteDescription" => $this->option->get('site_description'),
                "siteKeywords"    => $this->option->get('site_keywords'),
                "footer"          => $this->option->get('footer_copyright'),
            ]
        );
    }
}