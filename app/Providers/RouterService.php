<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:16
 */

namespace App\Providers;


use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Cli\Router;

/**
 * Class RouterService
 *
 * @package App\Providers
 */
class RouterService extends AbstractServiceProvider
{
    protected $serviceName = 'router';
    protected $shared      = true;

    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     */
    public function register ()
    {
        /** @var Router $router */
        $router = $this->getDI()->get('router');
        $routerFile = base_path('router', 'index.php');
        /** @noinspection PhpIncludeInspection */
        $router = require $routerFile;
        $router->handle();
        return $router;
    }
}