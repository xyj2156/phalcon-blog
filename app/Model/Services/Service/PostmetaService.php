<?php

namespace App\Model\Services\Service;

use App\Model\Postmeta;
use App\Model\Services\AbstractService;

/**
 * Class PostmetaService
 *
 * @package ZPhal\Models\Services\Service
 */
class PostmetaService extends AbstractService
{
    /**
     * @var mixed|\Phalcon\DiInterface
     */
    private static $modelsManager;

    /**
     * PostService constructor.
     *
     * @param  null  $di
     */
    public function __construct ($di = null)
    {
        parent::__construct($di);
        self::$modelsManager = $this->di->get('modelsManager') ?: container('modelsManager');
    }

    /**
     * 删除postmeta中的trash制造的部分
     *
     * @param $id
     *
     * @return \Phalcon\Mvc\Model\Criteria
     */
    public function deleteTrashMeta ($id)
    {
        $phql = "DELETE FROM ".Postmeta::class." WHERE post_id = :postId: AND (meta_key = '_zp_trash_meta_time' OR meta_key = '_zp_trash_meta_status')";
        return self::$modelsManager->executeQuery(
            $phql,
            [
                "postId" => $id,
            ]
        );
    }
}