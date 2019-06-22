<?php

namespace App\Providers;

use App\Library\Widget\Widget;
use App\Providers\ServiceProvider\AbstractServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package ZPhal\Providers\Widget
 */
class WidgetService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'widget';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册widget服务
     *
     * @return mixed
     */
    public function register ()
    {
        return new Widget();
    }
}