<?php

namespace App\Library\Paginator;

use App\Library\Paginator\Pager\Layout;
use App\Library\Paginator\Pager\Range\Sliding;
use Phalcon\Paginator\AdapterInterface;

/**
 * Class Pager
 *
 * @package App\Library\Paginator
 */
class Pager implements \IteratorAggregate, \Countable
{
    /**
     * Phalcon's paginate result.
     *
     * @var \stdClass
     */
    protected $paginateResult = null;

    /**
     * Array with options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Current rows limit (if provided)
     *
     * @var integer|null
     */
    protected $limit = null;

    /**
     * Class constructor.
     *
     * Consumes Phalcon paginator adapter and options array.
     * Option keys:
     *     - rangeClass:  Class name which determines scrolling style type (e.g. Phalcon\Paginator\Pager\Range\Sliding).
     *                    Defaults to "Phalcon\Paginator\Pager\Range\Sliding".
     *     - rangeLength: Size of range to be used. Default size is 10.
     *     - layoutClass: Used with getLayout() method. Defaults to "Phalcon\Paginator\Pager\Layout".
     *     - urlMask:     Required with getLayout() method.
     *
     * @param  AdapterInterface  $adapter  Phalcon paginator adapter
     * @param  array  $options  options array
     *
     */
    public function __construct (AdapterInterface $adapter, array $options = [])
    {
        $this->paginateResult = $adapter->getPaginate();

        $this->limit = $adapter->getLimit();
        $this->options = $options;
    }

    /**
     * Get current rows limit (if provided)
     *
     * @return integer|null
     */
    public function getLimit ()
    {
        return $this->limit;
    }

    /**
     * Return true if it's necessary to paginate or false if not.
     *
     * @return boolean
     */
    public function haveToPaginate ()
    {
        return $this->paginateResult->total_pages > 1;
    }

    /**
     * return the total page
     *
     * @return mixed
     */
    public function getTotalPage ()
    {
        return $this->paginateResult->total_pages;
    }

    /**
     * Returns the current page.
     *
     * @return integer
     */
    public function getCurrentPage ()
    {
        return $this->paginateResult->current;
    }

    /**
     * Returns the first page.
     *
     * @return integer
     */
    public function getFirstPage ()
    {
        return $this->paginateResult->first;
    }

    /**
     * Returns the previous page.
     *
     * @return integer
     */
    public function getPreviousPage ()
    {
        return $this->paginateResult->before;
    }

    /**
     * Returns the next page.
     *
     * @return integer
     */
    public function getNextPage ()
    {
        return $this->paginateResult->next;
    }

    /**
     * Returns the last page.
     *
     * @return integer
     */
    public function getLastPage ()
    {
        return $this->paginateResult->last;
    }

    /**
     * Returns the layout object.
     *
     * @return \Phalcon\Paginator\Pager\Layout
     * @throws \RuntimeException               in case options are not properly set
     */
    public function getLayout ()
    {
        if (!array_key_exists('layoutClass', $this->options)) {
            $this->options['layoutClass'] = Layout::class;
        }

        if (!array_key_exists('urlMask', $this->options)) {
            throw new \RuntimeException('You must provide option "urlMask"');
        }

        $range = null;
        $rangeClass = $this->getRangeClass();
        $rangeLength = $this->getRangeLength();

        if (!class_exists($rangeClass)) {
            throw new \RuntimeException(sprintf('Unable to find range class "%s"', $rangeClass));
        }

        if (!class_exists($this->options['layoutClass'])) {
            throw new \RuntimeException(sprintf('Unable to find layout "%s"', $this->options['layoutClass']));
        }

        return new $this->options['layoutClass'](
            $this,
            new $rangeClass($this, $rangeLength),
            $this->options['urlMask']
        );
    }

    /**
     * Returns array of page numbers that are in range of slider.
     *
     * @return array array of page numbers
     */
    public function getPagesInRange ()
    {
        /** @var \Phalcon\Paginator\Pager\Range $range */
        $rangeClass = $this->getRangeClass();
        $range = new $rangeClass($this, $this->getRangeLength());

        return $range->getRange();
    }

    /**
     * {@inheritdoc}
     *
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        if (!$this->paginateResult->items instanceof \Iterator) {
            return new \ArrayIterator($this->paginateResult->items);
        }

        return $this->paginateResult->items;
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function count ()
    {
        return intval($this->paginateResult->total_items);
    }

    /**
     * RangeClass option getter.
     *
     * @return string range class name
     */
    protected function getRangeClass ()
    {
        if (!array_key_exists('rangeClass', $this->options)) {
            $this->options['rangeClass'] = Sliding::class;
        }

        return $this->options['rangeClass'];
    }

    /**
     * RangeLength option getter.
     *
     * @return integer range length
     */
    protected function getRangeLength ()
    {
        if (!array_key_exists('rangeLength', $this->options)) {
            $this->options['rangeLength'] = 10;
        }

        return (int) $this->options['rangeLength'];
    }
}
