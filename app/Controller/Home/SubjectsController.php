<?php

namespace App\Controller\Home;


use App\Model\Posts;
use App\Model\Subjects;
use App\Model\TermRelationships;

class SubjectsController extends HomeBase
{
    public function initialize ()
    {
        parent::initialize();

        $this->view->setTemplateAfter("subject");
    }

    /**
     * 专题展示
     *
     * @param  int  $parent
     */
    public function subjectAction ($parent = 0)
    {
        if (!$this->view->getCache()->exists('subject-'.$parent)) {

            $this->tag->prependTitle('专题'." - ");

            $subjects = Subjects::find([
                "parent = ?1",
                "bind" => [
                    1 => $parent,
                ],
            ])->toArray();

            if ($subjects) {
                foreach ($subjects as $key => $subject) {
                    $subjects[$key]['last_updated'] = calculateDateDiff($subject['last_updated']);
                    $subjects[$key]['link'] = $this->url->get(["for" => "subject", "params" => $subject['subject_id']]);
                }

                // Get self Info
                if ($parent > 0) {
                    $self = Subjects::findFirst($parent);
                    if ($self) {
                        $self = $self->toArray();
                    }
                } else {
                    $self = false;
                }

                $this->view->setVars([
                    'self'     => $self,
                    'subjects' => $subjects,
                ]);

                $this->view->cache(
                    [
                        'key' => 'subject-'.$parent,
                    ]
                );
            } else {
                $this->dispatcher->forward(
                    [
                        "controller" => "subjects",
                        "action"     => "detail",
                        [
                            "params" => $parent,
                        ],
                    ]
                );
            }
        } else {
            $this->view->cache(
                [
                    'key' => 'subject-'.$parent,
                ]
            );
        }
    }

    /**
     * 专题文章展示
     *
     * @param  int  $id
     */
    public function detailAction ($id = 0)
    {
        $subject = Subjects::findFirst([
            "subject_id = ?1",
            "bind" => [
                1 => $id,
            ],
        ]);

        if ($subject) {
            $this->tag->prependTitle($subject->subject_name." - ");

            $posts = $this->modelsManager->createBuilder()
                                         ->columns("p.ID, p.post_html_content, p.post_title, p.post_date, p.guid, p.comment_count, p.view_count")
                                         ->from(['sr' => TermRelationships::class])
                                         ->leftJoin(Posts::class, 'p.ID = sr.object_id', "p")
                                         ->where("sr.subject_id = :id: AND p.post_type = 'post' AND p.post_status = 'publish'",
                                             ["id" => $subject->subject_id])
                                         ->orderBy("sr.order_num ASC")
                                         ->getQuery()
                                         ->execute()
                                         ->toArray();

            $this->view->setVars([
                'posts'              => $posts,
                'total'              => count($posts),
                'subjectName'        => $subject->subject_name,
                'subjectDescription' => $subject->subject_description,
                'parent'             => $subject->parent,
            ]);

            $this->view->cache(
                [
                    'key' => 'subject-'.$id,
                ]
            );
        } else {
            $this->dispatcher->forward(
                [
                    "controller" => "error",
                    "action"     => "route404",
                ]
            );
        }
    }
}