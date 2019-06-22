<?php

namespace App\Controller\Home;

class ProjectsController extends HomeBase
{
    public function initialize ()
    {
        parent::initialize();

        $this->view->setTemplateAfter("project");
    }

    public function indexAction ()
    {
        if (!$this->view->getCache()->exists('projects')) {

            $this->tag->prependTitle('作品'." - ");

            if ($this->option->get('show_project')) {
                $ifShow = true;

                $showRepos = $this->option->get('github_show_repo', false, true);
                if ($showRepos) {
                    $showRepos = json_decode($showRepos, true);
                }


            } else {
                $ifShow = false;
            }

            $this->view->setVars([
                'ifShow'    => $ifShow,
                'showRepos' => $showRepos,
            ]);
        }

        $this->view->cache(
            [
                'key' => 'projects',
            ]
        );
    }

}