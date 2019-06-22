<?php

namespace App\Providers;

use App\Providers\ServiceProvider\AbstractServiceProvider;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

/**
 * Class TransactionsService
 *
 * @package App\Providers
 */
class TransactionsService extends AbstractServiceProvider
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName = 'transactions';
    protected $shared      = true;

    /**
     * {@inheritdoc}
     *
     * 注册错误信息获取服务
     *
     * @return mixed
     */
    public function register ()
    {
        /**
         * 注册事务管理器
         */
        return new TransactionManager();
    }
}