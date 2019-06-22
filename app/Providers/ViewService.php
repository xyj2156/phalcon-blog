<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:02
 */

namespace App\Providers;


use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Mvc\View;

/**
 * Class ViewService
 *
 * @package App\Providers
 */
class ViewService extends AbstractServiceProvider
{
    protected $serviceName = 'view';
    protected $shared      = false;

    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     */
    public function register ()
    {
        $themeDir = $this->di->get('config')->application->themesDir;
        $view = new View();
        $view->setDI($this->getDI());
        $view->setViewsDir($themeDir.'/default/');

        $view->registerEngines([
            '.phtml' => View\Engine\Php::class,
            '.volt'  => function ($view) {
                $volt = new View\Engine\Volt($view, container());
                $options = [
                    'compiledPath'      => base_path('runtime', 'volt').DS,
                    'compiledSeparator' => '_',
                ];
                env('APP_DEBUG') && 'production' !== container('config')->environment && $options['compileAlways'] = true;
                $volt->setOptions($options);

                return $volt;
            },
        ]);

        return $view;
    }
}