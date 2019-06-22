<?php

namespace App\Providers;

use App\Library\Options\Redis;
use App\Providers\ServiceProvider\AbstractServiceProvider;

/**
 * Class OptionService
 *
 * @package App\Providers
 */
class OptionService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'option';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册option服务
     *
     * @return mixed
     */
    public function register ()
    {
        return new Redis();
    }
}