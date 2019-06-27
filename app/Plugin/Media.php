<?php

namespace App\Plugin;

use Phalcon\Events\ManagerInterface;
use Phalcon\Events\EventsAwareInterface;
use App\Model\Resources;
use Phalcon\Http\Request\File;

class Media implements EventsAwareInterface
{
    protected $_eventsManager;

    public function setEventsManager (ManagerInterface $eventsManager)
    {
        $this->_eventsManager = $eventsManager;
    }

    public function getEventsManager ()
    {
        return $this->_eventsManager;
    }


    /**
     * 上传文件
     *
     * @param  File  $file
     * @param  string  $uploadType  上传类型(决定路径) resource|cover
     * @param  array  $extra  额外参数
     *
     * @return array
     */
    public function uploadMedia ($file, $uploadType, $extra = [])
    {
        if (is_object($this->_eventsManager)) {
            $this->_eventsManager->fire("media:beforeUploadMedia", $this, $file);
        }

//        配置信息
        $config = container('config');
        $mediaConf = $config->media;
        $uploadTypeConfig = $mediaConf->upload_type;

        if (!isset($uploadTypeConfig->{$uploadType})) {
            return $this->uploadStatus(403, '上传类型错误');
        }
//        组合路径信息
        $uploadBaseDir = $mediaConf->upload_basedir; // 上传路径
        $saveDir = $uploadTypeConfig->{$uploadType}.'/'.date('Ymd');
        $finalSaveDir = "{$uploadBaseDir}/{$saveDir}";
        $finalUrl = str_replace(base_path('public'), '', $finalSaveDir);

        if (!file_exists($finalSaveDir)) {
            @mkdir($finalSaveDir, 0777, true);
        }

        /**
         * 文件上传操作
         */
        $fileInfo = [];

        // 文件信息
        $fileInfo['fileTitle'] = $file->getName();
        $fileInfo['fileSize'] = $file->getSize();
        $fileInfo['fileType'] = $file->getType();
        $fileInfo['filename'] = random_str(12, '.'.$file->getExtension());
        $fileInfo['url'] = $finalUrl.'/'.$fileInfo['fileTitle'];

//        执行上传文件
        $newFile = $finalSaveDir.'/'.$fileInfo['fileTitle'];
        if (is_file($newFile)) {
            return $this->uploadStatus('error', '文件已存在！');
        }
        if (!$file->moveTo($newFile)) {
            $error = $file->getError();
            return $this->uploadStatus('error', '文件保存失败：'.$error);
        }

        /**
         * 存储到数据库
         */
        $save = $this->saveInfo($fileInfo);
        if ($save !== true) {
            return $this->uploadStatus('error', $save);
        }

        if (is_object($this->_eventsManager)) {
            $this->_eventsManager->fire("media:afterUploadMedia", $this, $file);
        }

        return $this->uploadStatus('success', '上传成功！', $fileInfo);
    }

    /**
     * 存储媒体信息到数据库
     *
     * @param $fileInfo
     *
     * @return bool|string
     */
    public function saveInfo ($fileInfo)
    {
        $resource = new Resources();

        $resource->upload_date = date('Y-m-d H:i:s', time());
        $resource->upload_date_gmt = gmdate('Y-m-d H:i:s', time());
        $resource->resource_title = $fileInfo['fileTitle'];
        $resource->resource_name = $fileInfo['filename'];
        $resource->resource_parent = 0;
        $resource->guid = $fileInfo['url'];

        //$resource->resource_type
        $resource->resource_mime_type = $fileInfo['fileType'];


        // TODO 读取配置,是否裁剪图片

        if ($resource->create() === false) {
            $output = "文件信息保存失败：\n";

            $msgs = $resource->getMessages();
            foreach ($msgs as $msg) {
                $output .= $msg->getMessage()."\n";
            }

            return $output;
        } else {
            return true;
        }
    }

    /**
     * 返回上传状态
     *
     * @param $status
     * @param $message
     * @param  array  $data
     *
     * @return array
     */
    public function uploadStatus ($status, $message, $data = [])
    {
        return [
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * 图片处理
     */
}