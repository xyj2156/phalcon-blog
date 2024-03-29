<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'链接列表'}) }}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="<?= $this->url->get(["for" => "list-link"]); ?>" method="get">

                        <div class="row">
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <select class="form-control">
                                        <option>批量操作</option>
                                        <option>删除</option>
                                    </select>
                                    <div class="input-group-btn">
                                        <button id="add-new-event" type="button" class="btn btn-default btn-flat">应用
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-1">
                                        <div class="input-group">
                                            <select class="form-control" name="linkCategory">
                                                <option value="0">所有链接分类目录</option>
                                                <?php foreach ($linkCategory as $category) { ?>
                                                    <option value="<?= $category['term_taxonomy_id'] ?>" <?php if ($category['term_taxonomy_id'] == $selectedCategory) echo 'selected' ?>><?= $category['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-group-btn">
                                                <button id="add-new-event" type="submit"
                                                        class="btn btn-default btn-flat">筛选
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control pull-right" placeholder="名称关键字"
                                           value="<?= $search ?>">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="30%">名称</th>
                            <th width="20%">URL</th>
                            <th width="20%">分类目录</th>
                            <th width="10%">可见性</th>
                            <th width="20%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = $links->getIterator();
                        if (count($result)) {
                            foreach ($result as $k => $link) {
                                ?>
                                <tr>
                                    <td><a href="<?= $this->url->get([
                                            "for" => "edit-link", "id" => $link->link_id,
                                        ]); ?>"><?= $link->link_name ?></a></td>
                                    <td><?= $link->link_url ?></td>
                                    <td><?= $link->taxonomy ?></td>
                                    <td>
                                        <?php if ($link->link_visible == 'Y') {
                                            echo '是';
                                        } else {
                                            echo '否';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="<?= $this->url->get([
                                            "for" => "edit-link", "id" => $link->link_id,
                                        ]); ?>" class="btn btn-xs bg-purple"><i class="fa fa-edit"></i> 编辑</a>
                                        <a class="btn btn-xs btn-danger" data-toggle="modal"
                                           data-target="#trash_modal_<?= $link->link_id ?>"><i
                                                    class="fa fa-trash-o"></i> 删除</a>

                                        <div class="modal modal-danger fade" id="trash_modal_<?= $link->link_id ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">删除</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>确定要删除吗？该操作不可逆。</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline pull-left"
                                                                data-dismiss="modal">取消
                                                        </button>
                                                        <a href="<?= $this->url->get([
                                                            "for" => "delete-link", "id" => $link->link_id,
                                                        ]); ?>" type="button" class="btn btn-outline">确定</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center">无</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>名称</th>
                            <th>URL</th>
                            <th>分类目录</th>
                            <th>可见性</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="box-footer clearfix">
                    <?php if ($links->haveToPaginate()) {
                        echo $links->getLayout();
                    } ?>
                </div>
            </div>
        </div>
    </div>

</section>