<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/23
 * Time: 20:23
 */

namespace App\Providers;


use Phalcon\Logger\Adapter;
use Phalcon\Logger\Exception;
use Phalcon\Logger\FormatterInterface;

class LoggerService extends ServiceProvider\AbstractServiceProvider
{
    protected $serviceName = 'logger';
    protected $shared      = true;

    /**
     * 注册应用服务
     * Register application service.
     *
     * @return mixed
     * @throws Exception
     */
    public function register ()
    {
//        所有配置
        $configAll = container('config')->logger;
        $default = $configAll->default;

//        单独一个适配器的配置
        $configAdapter = $configAll->device->{$default};

//        格式化适配器的配置
        $formatterConfig = $configAll->device->{strtolower($configAll->formatter)};
        if (empty($configAdapter) or empty($formatterConfig)) {
            throw new Exception('没有找到对应的日志配置或者格式化适配器的配置');
        }
//        组装 日志适配器 和 格式化适配器 类名
        $className = $configAdapter->adapter;
        if (!class_exists($className)) {
            $className = "\Phalcon\Logger\Adapter\\{$configAdapter -> adapter}";
        }
        $formatterName = $configAll->formatter;
        if (!class_exists($formatterName)) {
            $formatterName = "Phalcon\Logger\Formatter\\{$configAll -> formatter}";
        }

        if (!class_exists($className) or !class_exists($formatterName)) {
            throw new Exception('没有找到对应的日志适配器');
        }

//        组合日志文件
        $filePath = $configAdapter->path;
        $fileName = date($configAdapter->file).$configAdapter->extension;
        $file = "{$filePath}/{$fileName}";

        /** @var FormatterInterface $formatter */
        $formatter = new $formatterName($formatterConfig->format, $formatterConfig->date_format);

        /** @var Adapter $logger */
        $logger = new $className($file);
        $logger->begin();
        $logger->setFormatter($formatter);

        return $logger;
    }
}