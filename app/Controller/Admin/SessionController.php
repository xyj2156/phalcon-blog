<?php

namespace App\Controller\Admin;


use App\Model\Users;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

class SessionController extends AdminBase
{
    /**
     * set user session
     *
     * @param $user
     */
    public function _registerSession ($user)
    {
        $this->session->set(
            'userAuth',
            [
                'userId'    => $user->ID,
                'userLogin' => $user->user_login,
                'userRole'  => $user->user_role,
            ]
        );
    }

    /**
     * check login
     *
     * @return Response|ResponseInterface
     */
    public function loginAction ()
    {
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                // token is ok

                $inputUser = $this->request->getPost("user");
                $password = $this->request->getPost("password");

                $user = Users::findFirst(
                    [
                        "user_login = :login: AND user_status = 0",
                        'bind' => [
                            'login' => $inputUser,
                        ],
                    ]
                );

                if ($user) {
                    if ($this->security->checkHash($password, $user->user_pass)) {
                        $this->_registerSession($user);

                        $this->flash->notice("登陆成功！欢迎 ".$user->user_nickname." ！");
                        return $this->response->redirect("admin/");
                    }
                } else {
                    // 防止定时攻击。不管用户是否存在，脚本的计算量将与计算哈希数相同。
                    $this->security->hash(rand());
                }

                // The validation has failed
                $this->flash->error('帐号或密码错误！');
            } else {
                // error token
                $this->flash->error('登录异常！');
            }

        }
        // 返回登录页面
        return $this->response->redirect("login");
    }

    /**
     * logout
     *
     * @return Response|ResponseInterface
     */
    public function logoutAction ()
    {
        // 销毁全部session会话
        $this->session->destroy();

        // 返回登录页面
        return $this->response->redirect("login");
    }
}
