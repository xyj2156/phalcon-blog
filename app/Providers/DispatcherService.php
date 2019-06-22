<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 21:23
 */

namespace App\Providers;


use App\Plugin\NotFoundPlugin;
use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

class DispatcherService extends AbstractServiceProvider
{
    protected $serviceName = 'dispatcher';
    protected $shared      = true;

    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     */
    public function register ()
    {
        // dispatcher
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('ZPhal\Modules\Frontend\Controllers\\');

        // eventsManager
        $debug = container('config')->debug;
        $environment = container('config')->environment;
        if ($environment == 'production' && $debug === false) {
            // 创建一个事件管理器
            $eventsManager = new EventsManager();

            // 监听分发器中使用安全插件产生的事件
            /*$eventsManager->attach(
                "dispatch:beforeExecuteRoute",
                new SecurityPlugin()
            );*/

            // 处理异常和使用 NotFoundPlugin 未找到异常
            $eventsManager->attach(
                "dispatch:beforeException",
                new NotFoundPlugin()
            );

            $dispatcher->setEventsManager($eventsManager); // 分配事件管理器到分发器
        }

        return $dispatcher;
    }
}