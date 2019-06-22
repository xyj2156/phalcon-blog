<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Mvc\Url as UrlResolver;

/**
 * Class UrlService
 *
 * @package App\Providers
 */
class UrlService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'url';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册URL服务
     *
     * @return mixed
     */
    public function register ()
    {
        $config = $this->getDI()->getConfig();

        $url = new UrlResolver();
        $url->setBaseUri($config->application->baseUri);

        return $url;
    }
}