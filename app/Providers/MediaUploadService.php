<?php

namespace App\Providers;

use App\Plugin\AliYunOss;
use App\Plugin\Media;
use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Events\Manager as EventsManager;


/**
 * 文件上传
 * Class MediaUploadService
 *
 * @package App\Providers
 */
class MediaUploadService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'mediaUpload';
    protected $shared      = false;

    /**
     * {@inheritdoc}
     *
     * 注册视图服务
     *
     * @return mixed
     */
    public function register ()
    {
        /**
         * 注册一个文件上传服务
         */
        $media = new Media();

        // TODO 判断是否开启阿里云Oss
        // 创建一个事件管理器
        $eventsManager = new EventsManager();
        $eventsManager->attach(
            "media",
            new AliYunOss()
        );
        $media->setEventsManager($eventsManager);

        return $media;
    }
}