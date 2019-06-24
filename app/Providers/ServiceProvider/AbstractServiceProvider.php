<?php

namespace App\Providers\ServiceProvider;

use LogicException;
use Phalcon\DiInterface;
use Phalcon\Mvc\User\Component;

/**
 * 服务提供者抽象类
 * Class AbstractServiceProvider
 *
 * @package App\Providers\ServiceProvider
 */
abstract class AbstractServiceProvider extends Component implements ServiceProviderInterface
{
    /**
     * 服务名称
     *
     * @var string
     */
    protected $serviceName;

    private   $serverValue;
    private   $serviceCache = [];
    protected $shared       = true;

    final public function __construct (DiInterface $di)
    {
        if (!$this->serviceName) {
            throw new LogicException(
                sprintf('服务提供者 "%s" 的名字不能为空。', get_class($this))
            );
        }

        $this->setDI($di);

        $this->configure($this->getService());
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName ()
    {
        return $this->serviceName;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function boot ($shared = null)
    {
        $shared = is_null($shared) ? $this->shared : $shared;
//        启动方法中自动注册
        $this->di->set($this->getName(), $this->getService(), $shared);
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function configure ($service = null)
    {
    }

    public function getService ()
    {
        if (empty($this->serverValue)) {
            $this->serverValue = $this->register();
        }
        return $this->serverValue;
    }

    public static function handle (DiInterface $di, $shared = false)
    {
        $obj = new static($di);
        $obj->boot($shared);
        unset($obj);
    }
}
