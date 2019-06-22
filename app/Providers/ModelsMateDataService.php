<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;

/**
 * 模型元数据
 * Class ModelsMateDataService
 *
 * @package App\Providers
 */
class ModelsMateDataService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'modelsMetadata';
    protected $shared      = false;

    /**
     * {@inheritdoc}
     *
     * 注册配置服务
     *
     * @return void
     */
    public function register ()
    {
        return new MetaDataAdapter();
    }
}