<?php

namespace App\Controller\Admin;

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

        $resources = $this->modelsManager->createBuilder()
                                         ->columns([
                                             "resource_id", "upload_date", "resource_title", "guid", "resource_type",
                                         ])
                                         ->from("ZPhal\Models\Resources")
                                         ->where("upload_author = {$userId}")
                                         ->orderBy("resource_id DESC")
                                         ->limit(20, 0)
                                         ->getQuery()
                                         ->execute()
                                         ->toArray();


        foreach ($resources as $key => $resource) {
            $resources[$key]['guid'] = $this->config->application->baseUri.$resource['guid'];
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

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );

        $this->assets->addCss("backend/library/bootstrap-fileinput/css/fileinput.min.css", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/js/fileinput.min.js", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/js/locales/zh.js", true);
        $this->assets->addJs("backend/library/bootstrap-fileinput/themes/fa/theme.min.js", true);

    }

    /**
     * 上传操作
     *
     * @return mixed
     */
    public function uploadAction ()
    {
        // 检测是否上传文件
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles(); // 获取上传的文件
            /** @var Media $media */
            $media = $this->di->get('mediaUpload');

            foreach ($files as $file) {
                $upload = $media->uploadMedia($file, 'resource');
                return json_encode([$upload['status'] => $upload['message']]);
            }
        }
    }
}