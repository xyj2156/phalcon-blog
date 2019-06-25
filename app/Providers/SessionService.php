<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Session\AdapterInterface;

/**
 * Class SessionService
 *
 * @package App\Providers
 */
class SessionService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'session';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册session服务
     *
     * @return AdapterInterface
     */
    public function register ()
    {
        $config = container('config')->session;

        $driver = $config->drivers->{$config->default};
        $adapter = '\Phalcon\Session\Adapter\\'.$driver->adapter;
        // 公共配置参数,将用于与adapter配置参数合并
        $defaults = [
            'prefix'   => $config->prefix,
            'uniqueId' => $config->uniqueId,
            'lifetime' => $config->lifetime,
        ];
//        添加如果redis 有密码的情况
        if (!empty($driver->auth)) {
            $defaults['auth'] = $driver->auth;
        }

        /** @var AdapterInterface $session */
        $session = new $adapter(array_merge($driver->toArray(), $defaults));
        $session->start();

        return $session;
    }
}