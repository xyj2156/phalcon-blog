<?php

namespace App\Libaray\Paginator\Pager;

use App\Library\Paginator\Pager;

/**
 * App\Libaray\Paginator\Pager\Range
 * Base class for ranges objects.
 */
abstract class Range
{
    /**
     * Pager object.
     *
     * @var Pager $pager
     */
    protected $pager = null;

    /**
     * Window size.
     *
     * @var integer
     */
    protected $chunkLength = 0;

    /**
     * Class constructor.
     *
     * @param  \Phalcon\Paginator\Pager  $pager
     * @param  integer  $chunkLength
     */
    public function __construct (Pager $pager, $chunkLength)
    {
        $this->pager = $pager;
        $this->chunkLength = abs(intval($chunkLength));

        if ($this->chunkLength == 0) {
            $this->chunkLength = 1;
        }
    }

    /**
     * Calculate and returns an array representing the range around the current page.
     *
     * @return array
     */
    abstract public function getRange ();
}
