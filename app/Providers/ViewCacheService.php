<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Cache\Frontend\Output;

/**
 * Class ViewCacheService
 *
 * @package App\Providers
 */
class ViewCacheService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'viewCache';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册视图缓存服务
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function register ()
    {
        $config = container('config')->cache;

        $driver = $config->drivers->{$config->views};
        $adapter = '\Phalcon\Cache\Backend\\'.$driver->adapter;

        if (!file_exists($driver->cacheDir)) {
            mkdir($driver->cacheDir, 0777, true);
        }

        return new $adapter(
            new Output(['lifetime' => $config->lifetime]),
            $driver->toArray()
        );
    }
}