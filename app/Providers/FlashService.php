<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Flash\Session;

/**
 * 闪存提示
 * Class FlashService
 *
 * @package App\Providers
 */
class FlashService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'flash';
    protected $shared      = false;

    protected $bannerStyle = [
        'error'   => 'alert alert-danger fade in',
        'success' => 'alert alert-success fade in',
        'notice'  => 'alert alert-info fade in',
        'warning' => 'alert alert-warning fade in',
    ];

    /**
     * {@inheritdoc}
     *
     * 注册Flash服务,使用Bootstrap的类
     *
     * @return mixed
     */
    public function register ()
    {
        $bannerStyle = $this->bannerStyle;
        $flash = new Session($bannerStyle);

        $flash->setAutoescape(true);
        $flash->setDI(container());
        $flash->setCssClasses($bannerStyle);

        return $flash;
    }
}
