<?php

namespace App\Controller\Admin;

use App\Model\Resources;
use App\Plugin\Media;
use Phalcon\Mvc\View;

/**
 * 媒体操作类
 *
 * TODO 详情页面 图片信息修改 永久删除 动态加载列表 筛选 搜索   文件大小
 *
 * TODO 阿里云OSS插件  图片切割(捞配置)
 *
 * Class MediaController
 *
 * @package App\Controller\Admin
 */
class MediaController extends AdminBase
{
    public function initialize ()
    {
        parent::initialize();
    }

    /**
     * 媒体库列表
     */
    public function indexAction ()
    {
        $this->tag->prependTitle("媒体库 - ");

        $userId = $this->getUserId();

        $_resources = $this->modelsManager->createBuilder()
                                          ->columns([
                                              "resource_id", "upload_date", "resource_title", "guid", "resource_type",
                                          ])
                                          ->from(Resources::class)
                                          ->where("upload_author = {$userId}")
                                          ->orderBy("resource_id DESC")
                                          ->limit(20, 0)
                                          ->getQuery()
                                          ->execute();

        $resources = [];
        foreach ($_resources as $key => $resource) {
            $resource->guid = $this->config->application->baseUri.$resource['guid'];
            $resources[$key] = $resource;
        }
        //print_r($resources);exit;
        $this->view->setVars(
            [
                "resources" => $resources,
            ]
        );
    }

    /**
     * 添加媒体页
     */
    public function newAction ()
    {
        $this->tag->prependTitle("媒体添加 - ");


        $this->assets->addCss("backend/library/bootstrap-fileinput/css/fileinput.min.css", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/js/fileinput.min.js", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/js/locales/zh.js", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/themes/fa/theme.min.js", true);
        $this->assets->addJs("backend/js/media_new.js", true);

    }

    /**
     * 上传操作
     *
     * @return mixed
     */
    public function uploadAction ()
    {
        if (!$this->request->hasFiles()) {
            return $this->response->setJsonContent([
                'status'  => 400,
                'message' => '没有文件被上传',
            ]);
        }
        $files = $this->request->getUploadedFiles(); // 获取上传的文件
        /** @var Media $media */
        $media = $this->di->get('mediaUpload');

        foreach ($files as $file) {
            $upload = $media->uploadMedia($file, 'resource');
            return json_encode([$upload['status'] => $upload['message']]);
        }
    }
}