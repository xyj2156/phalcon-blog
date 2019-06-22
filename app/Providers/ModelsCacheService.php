<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Cache\Frontend\Data;

/**
 * Class ModelsCacheService
 *
 * @package App\Providers
 */
class ModelsCacheService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'modelsCache';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册model缓存服务
     *
     * @return void
     */
    public function register ()
    {
        $config = container('config')->cache;

        $driver = $config->drivers->{$config->default};
        $adapter = '\Phalcon\Cache\Backend\\'.$driver->adapter;

        if ($driver->adapter == 'Redis') {
            $default = [
                'statsKey' => 'XYJ:'.substr(md5($config->prefix), 0, 16).'_',
                'prefix'   => 'XY_'.$config->prefix,
            ];
        } else {
            if (!file_exists($driver->cacheDir)) {
                mkdir($driver->cacheDir, 0777, true);
            }

            $default = [
                'prefix' => 'ZD_'.$config->prefix,
            ];
        }

        return new $adapter(
            new Data(['lifetime' => $config->lifetime]),
            array_merge($driver->toArray(), $default)
        );
    }
}