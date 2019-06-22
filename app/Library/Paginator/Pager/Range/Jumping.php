<?php

namespace App\Library\Paginator\Pager\Range;

use App\Libaray\Paginator\Pager\Range;

/**
 * App\Library\Paginator\Pager\Range\Jumping
 * Ranges, «jumping» over the pages, e.g.: when on
 *  [1] [2] 3
 *  next range will be:
 *  4 [5] [6]
 */
class Jumping extends Range
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getRange ()
    {
        $page = $this->pager->getCurrentPage();
        $startPage = $page - ($page - 1) % $this->chunkLength;
        $endPage = ($startPage + $this->chunkLength) - 1;

        if ($endPage > $this->pager->getLastPage()) {
            $endPage = $this->pager->getLastPage();
        }

        return range($startPage, $endPage);
    }
}
