<?php

namespace App\Controller\Home;


use App\Model\Posts;

class ArchivesController extends HomeBase
{
    public function initialize ()
    {
        parent::initialize();

        $this->view->setTemplateAfter("archive");
    }

    /**
     * 归档页面
     */
    public function indexAction ()
    {
        if (!$this->view->getCache()->exists('archives')) {

            $this->tag->prependTitle('归档'." - ");

            $posts = Posts::find([
                "conditions" => "post_status = 'publish' AND post_type = 'post' ",
                "columns"    => "ID, post_date, post_title, guid, comment_count",
                "order"      => "post_date DESC",
            ])->toArray();


            $arr = [];
            foreach ($posts as $key => $post) {
                $date = $this->checkDate($post['post_date']);
                $posts[$key]['theDay'] = $date['day'];
                $arr[$date['year']][$date['month']][] = $posts[$key];
            }

            $this->view->setVars([
                'list' => $arr,
            ]);
        }

        $this->view->cache(
            [
                'key' => 'archives',
            ]
        );
    }

    /**
     * 检查时间
     *
     * @param $time
     *
     * @return array
     */
    protected function checkDate ($time)
    {
        $timestamp = strtotime($time);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        $day = date("d", $timestamp);

        return [
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        ];
    }
}