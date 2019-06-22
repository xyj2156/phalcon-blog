<?php

namespace App\Library\User;

use Phalcon\Mvc\User\Component;

/**
 * User
 * TODO ACL实现后做
 *
 * 用户登录状态操纵和UI元素建立
 */
class UserElement extends Component
{
    private $_headerMenu = [
        'navbar-left'  => [
            'index'    => [
                'caption' => 'Home',
                'action'  => 'index',
            ],
            'invoices' => [
                'caption' => 'Invoices',
                'action'  => 'index',
            ],
            'about'    => [
                'caption' => 'About',
                'action'  => 'index',
            ],
            'contact'  => [
                'caption' => 'Contact',
                'action'  => 'index',
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action'  => 'index',
            ],
        ],
    ];

    private $_tabs = [
        'Invoices'      => [
            'controller' => 'invoices',
            'action'     => 'index',
            'any'        => false,
        ],
        'Companies'     => [
            'controller' => 'companies',
            'action'     => 'index',
            'any'        => true,
        ],
        'Products'      => [
            'controller' => 'products',
            'action'     => 'index',
            'any'        => true,
        ],
        'Product Types' => [
            'controller' => 'producttypes',
            'action'     => 'index',
            'any'        => true,
        ],
        'Your Profile'  => [
            'controller' => 'invoices',
            'action'     => 'profile',
            'any'        => false,
        ],
    ];

    public function getLogin ()
    {
        $auth = $this->session->get('userAuth');
        /*$auth['userId'];
        $auth['userLogin'];
        $auth['userRole'];*/
    }

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu ()
    {
        /**
         * TODO $_headerMenu $_tabs 数据库和缓存中取出;  侧栏菜单权限实现
         */
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action'  => 'end',
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }
        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller.'/'.$option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }

    /**
     * Returns menu tabs
     */
    public function getTabs ()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'].'/'.$option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }

}