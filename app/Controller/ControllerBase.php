<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jason
 * Date: 2019/6/21
 * Time: 18:25
 */

namespace App\Controller;

abstract class ControllerBase extends \Phalcon\Mvc\Controller
{
    /**
     * 允许访问的 http 方法
     *
     * @var array $mustBeMethod
     */
    protected $mustBeMethod = [];
    /**
     * 没有在允许内 跳转的地址
     *
     * @var string $notMethodRedirect
     */
    protected $notMethodRedirect;
    /**
     * 跳转后警告文字 默认 请正常操作
     *
     * @var string $notMethodWarning
     */
    protected $notMethodWarning;

    public function onConstruct ()
    {
        if ($timezone = $this->option->get('timezone_string')) {
            date_default_timezone_set($timezone);
        }
    }

    public function initialize ()
    {
        return true;
    }

    public function beforeExecuteRoute ()
    {
        /**
         * 判断方法必须是指定的一种或者几种 请求方法
         */
        if (!empty($this->mustBeMethod)) {
            foreach ($this->mustBeMethod as $action => $methods) {
                $actionName = $this->router->getActionName();
                if ($action != $actionName) {
                    continue;
                }
                $method = strtolower($this->request->getMethod());
                if (is_array($methods) ? !in_array($method, $methods) : $methods == $method) {
                    $this->view->disable();
                    $this->flash->warning($this->notMethodWarning ?? '请正常操作！');
                    $redirect = $this->notMethodRedirect ?? '/error/router404.html';
                    $this->response->redirect($redirect);
                    return false;
                }
            }
        }
        return true;
    }
}