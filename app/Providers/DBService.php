<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;

/**
 * 数据库
 * Class DBService
 *
 * @package App\Providers
 */
class DBService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'db';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册配置服务
     *
     * @return void
     */
    public function register ()
    {
        $config = container('config');

        $class = 'Phalcon\Db\Adapter\Pdo\\'.$config->database->adapter;
        $params = [
            'host'     => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname'   => $config->database->dbname,
            'charset'  => $config->database->charset,
        ];

        if ($config->database->adapter == 'Postgresql') {
            unset($params['charset']);
        }

        $connection = new $class($params);

        return $connection;
    }
}