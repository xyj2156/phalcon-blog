<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Cache\Backend\Redis as redisAdapter;
use Phalcon\Cache\Frontend\Data as FrontData;

/**
 * Class RedisService
 *
 * @package App\Providers
 */
class RedisService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'redis';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册redis服务
     *
     * @return mixed
     */
    public function register ()
    {
        $config = container('config')->cache;

        $driver = $config->drivers->redis;

        $redis = new redisAdapter(
            new FrontData(
                [
                    "lifetime" => $config->lifetime,
                ]
            ),
            $driver->toArray()
        );

        return $redis;
    }
}