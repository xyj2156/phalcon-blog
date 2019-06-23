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
    public function onConstruct ()
    {
        if ($timezone = $this->option->get('timezone_string')) {
            date_default_timezone_set($timezone);
        }
    }

    public function initialize ()
    {
    }

    public function afterAction ()
    {
        $pa = 1;
    }
}