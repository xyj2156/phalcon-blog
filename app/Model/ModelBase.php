<?php

namespace App\Model;

use Phalcon\Mvc\Model;

/**
 * model基类
 * Class ModelBase
 *
 * @package ZPhal\Models
 */
abstract class ModelBase extends Model
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
}