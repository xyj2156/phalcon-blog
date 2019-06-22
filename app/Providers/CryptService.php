<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Crypt;

/**
 * Class CryptService
 *
 * @package App\Providers
 */
class CryptService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'crypt';
    protected $shared      = false;

    /**
     * {@inheritdoc}
     *
     * 注册crypt加密服务
     *
     * @return void
     */
    public function register ()
    {
        $config = container('config');
        $key = $config->security->crypt->key;

        $crypt = new Crypt();
        $crypt->setKey($key); // 加密key

        return $crypt;
    }
}