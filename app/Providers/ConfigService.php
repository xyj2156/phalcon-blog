<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 17:15
 */

namespace App\Providers;


use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Config;

/**
 * Class ConfigService
 *
 * @package App\Providers
 */
class ConfigService extends AbstractServiceProvider
{
    protected $serviceName = 'config';
    protected $shared      = false;

    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     */
    public function register ()
    {
        $path = config_path();
        $list = scandir($path);
        $all = [];
        foreach ($list as $filename) {
            if ($filename == '.' || $filename == '..') {
                continue;
            }
            $filePath = config_path($filename);
            $fileInfo = pathinfo($filePath);
            if ($fileInfo['extension'] !== 'php') {
                continue;
            }
            /** @noinspection PhpIncludeInspection */
            $ret = include $filePath;
            if (!$ret) {
                continue;
            }
            $all[$fileInfo['filename']] = $ret;
        }
        return new Config($all);
    }
}