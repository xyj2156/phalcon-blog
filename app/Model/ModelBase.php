<?php

namespace App\Model;

use Phalcon\Mvc\Model;

/**
 * model基类
 * Class ModelBase
 *
 * @package ZPhal\Models
 */
abstract class ModelBase extends Model implements \ArrayAccess
{
    protected $prefix = 'zp_';
    protected $table  = '';

    /**
     * Initialize method for model.
     */
    public function initialize ()
    {
        $this->setSource("{$this -> prefix}{$this -> table}");
//        $this->setSchema("zphaldb");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param  mixed  $parameters
     *
     * @return Model\ResultsetInterface
     */
    public static function find ($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param  mixed  $parameters
     *
     * @return Model
     */
    public static function findFirst ($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * 判断某键是不是存在
     *
     * @param  mixed  $offset
     *
     * @return bool|void
     */
    public function offsetExists ($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * 获取某个键 对应的值
     *
     * @param  mixed  $offset
     *
     * @return mixed|void
     */
    public function offsetGet ($offset)
    {
        if (isset($this->$offset)) {
            return $this->$offset;
        }
        return null;
    }

    /**
     * 设置某个键的值
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     *
     * @return mixed|void
     */
    public function offsetSet ($offset, $value)
    {
        return $this->$offset = $value;
    }

    /**
     * 删除某个键值
     *
     * @param  mixed  $offset
     */
    public function offsetUnset ($offset)
    {
        unset($this->{$offset});
    }
}