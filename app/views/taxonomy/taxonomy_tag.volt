<div class="col-md-4">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">添加新的标签</h3>
        </div>

        <form class="form-horizontal"
              action="{{ url.get({'for':'new-taxonomy', 'type':type}) }}"
              method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputUser" class="col-sm-2 control-label">名称</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="名称"
                               autocomplete="on">
                        <span class="help-block">名称是在站点上显示的名字。</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">别名</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="别名"
                               autocomplete="on">
                        <span class="help-block">“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc" class="col-sm-2 control-label">描述</label>
                    <div class="col-sm-10">
                                        <textarea class="form-control" id="desc" rows="3" placeholder="写一点东西吧..."
                                                  name="description" autocomplete="on"></textarea>
                        <span class="help-block">关于该标签的描述。</span>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">添加新的标签</button>
            </div>
        </form>
    </div>
</div>

{{ partial('taxonomy/taxonomy_table', {'table_title':'标签列表'}) }}