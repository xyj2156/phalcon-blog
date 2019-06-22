<?php

namespace App\Model;

class Options extends ModelBase
{
    protected $table = 'options';

    public $option_id;

    public $option_name;

    public $option_value;

    public $autoload;

    const AUTO_YES = 'yes';

    const AUTO_NO = 'no';


    public function afterSave ()
    {

    }

    /**
     * 是否自动加载
     *
     * @return bool
     */
    public function ifAutoload ()
    {
        if ($this->autoload === self::AUTO_YES) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 重新编排查询到的数据
     *
     * @param  null  $parameters
     *
     * @return array
     */
    public static function find ($parameters = null)
    {
        $options = parent::find($parameters);

        $output = [];

        if ($options) {
            foreach ($options as $option) {
                $output[$option['option_name']] = $option['option_value'];
            }
        }

        return $output;
    }
}
