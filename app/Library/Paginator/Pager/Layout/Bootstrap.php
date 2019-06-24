<?php

namespace App\Library\Paginator\Pager\Layout;

use App\Library\Paginator\Pager\Layout;

/**
 * Class Bootstrap
 *
 * @package App\Library\Paginator\Pager\Layout
 */
class Bootstrap extends Layout
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $template = '<li class="page-item"><a class="page-link" href="{%url}">{%page}</a></li>';

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $selectedTemplate = '<li class="page-item active"><a class="page-link" href="#"><span>{%page}</span></a></li>';

    /**
     * {@inheritdoc}
     *
     * @param  array  $options
     *
     * @return string
     */
    public function getRendered (array $options = [])
    {
        $result = '<ul class="pagination pagination-sm justify-content-center">';

        $bootstrapSelected = '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">{%page}</a></li>';
        $originTemplate = $this->selectedTemplate;
        $this->selectedTemplate = $bootstrapSelected;

        $this->addMaskReplacement('page', '&laquo;', true);
        $options['page_number'] = $this->pager->getPreviousPage();
        $result .= $this->processPage($options);

        $this->selectedTemplate = $originTemplate;
        $this->removeMaskReplacement('page');
        $result .= parent::getRendered($options);

        $this->selectedTemplate = $bootstrapSelected;

        $this->addMaskReplacement('page', '&raquo;', true);
        $options['page_number'] = $this->pager->getNextPage();
        $result .= $this->processPage($options);

        $this->selectedTemplate = $originTemplate;

        $result .= '</ul>';

        return $result;
    }
}
