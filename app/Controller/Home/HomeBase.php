<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:28
 */

namespace App\Controller\Home;

use App\Controller\ControllerBase;
use Phalcon\Tag;

abstract class HomeBase extends ControllerBase
{

    public function initialize ()
    {
        parent::initialize();
//        $this->view->setTemplateAfter("common");
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
//        前台静态资源
        $this->assets->addCss('themes/default/public/library/bootstrap/css/bootstrap.min.css', true);
        $this->assets->addCss('themes/default/public/library/font-awesome-4.7.0/css/font-awesome.min.css', true);
        $this->assets->addCss('themes/default/public/css/globals.css', true);

        $this->assets->addJs('themes/default/public/js/jquery.min.js', true);
        $this->assets->addJs('themes/default/public/js/popper.min.js', true);
        $this->assets->addJs('themes/default/public/library/bootstrap/js/bootstrap.min.js', true);
        $this->assets->addJs('themes/default/public/js/ie10-viewport-bug-workaround.js', true);
    }
}