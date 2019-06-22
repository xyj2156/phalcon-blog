<?php

namespace App\Providers;

use App\Library\Visit\Counter;
use App\Providers\ServiceProvider\AbstractServiceProvider;

/**
 * Class VisitService
 *
 * @package App\Providers
 */
class VisitCounterService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'visitCounter';
    protected $shared      = false;

    /**
     * {@inheritdoc}
     *
     * 注册浏览量统计visitCounter服务
     *
     * @return mixed
     */
    public function register ()
    {
        return new Counter();
    }
}