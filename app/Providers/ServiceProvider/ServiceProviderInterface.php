<?php

namespace App\Providers\ServiceProvider;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;

/**
 * 服务提供者接口
 * Interface ServiceProviderInterface
 *
 * @package App\Providers\ServiceProvider
 */
interface ServiceProviderInterface extends InjectionAwareInterface
{
    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     */
    public function register ();

    /**
     * 启动方法
     * Package boot method.
     *
     * @return void
     */
    public function boot ();

    /**
     * 配置当前服务提供者
     * Configures the current service provider.
     *
     * @param $service null|mixed
     *
     * @return void
     */
    public function configure ($service = null);

    /**
     * 获取服务名称
     * Get the Service name.
     *
     * @return string
     */
    public function getName ();

    /**
     * 获取 register 返回的服务值
     *
     * @return mixed
     */
    public function getService ();

    static public function handle (DiInterface $di);
}
