<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':id is defined ? '编辑专题' : '新专题','_2title':id is defined ? '编辑专题：'~name : '添加一个新专题，专题可以有层级关系'}) }}


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form
                    class="form-horizontal"
                    action="{% if id is defined %}{{ url.get({'for':'update-subject','id':id}) }}{% else %}{{ url.get('admin/subject/save') }}{% endif %}"
                    method="post"
                    enctype="multipart/form-data"
            >
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ id is defined ? '编辑专题：'~name : '添加新专题' }}</h3>
                    </div>

                    <div class="box-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="inputUser" class="col-sm-2 control-label">专题名称</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="名称"
                                           value="{{ name|default('') }}">
                                    <span class="help-block">名称是在站点上显示的名字。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">别名</label>
                                <div class="col-sm-6">
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="别名"
                                           value="{{ slug|default('') }}">
                                    <span class="help-block">“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">父级专题</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="parent">
                                        {{ subjectTree }}
                                    </select>
                                    <span class="help-block">“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>
                                </div>
                            </div>
                            {% if image is defined %}
                                <div class="form-group">
                                    <label for="inputFile" class="col-sm-2 control-label">当前封面图</label>
                                    <div class="col-sm-8">
                                        <img src="{{ image }}" width="200" height="200">
                                    </div>
                                </div>
                            {% endif %}

                            <div class="form-group">
                                <label for="inputFile" class="col-sm-2 control-label">新封面图</label>
                                <div class="col-sm-8">
                                    <input type="file" name="file" id="inputFile">
                                    <span class="help-block">一张该主题的封面图，可能展示在主题页面中；注意图片的命名不能重复。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-8">
                                    <textarea
                                            class="form-control"
                                            id="desc"
                                            rows="3"
                                            placeholder="写一点东西吧..."
                                            name="description"
                                    >{{ description|default('') }}</textarea>
                                    <span class="help-block">关于该分类目录的描述。</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {% if id is defined %}
                        <div class="box-footer  text-center">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"
                                    style="margin-right: 30px">
                                确定修改
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-danger">
                                删除
                            </button>
                        </div>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">修改提示</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>确定要修改该主题吗？</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消
                                        </button>
                                        <button type="submit" class="btn btn-primary">确定</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal modal-danger fade" id="modal-danger">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">删除提示</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>确定要删除吗？删除后将不可复原&hellip;</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">取消
                                        </button>
                                        <a href="{{ url.get({'for':'delete-subject', 'id':id}) }}"
                                           type="button" class="btn btn-outline">确定</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% else %}
                        <div class="box-footer  text-center">
                            <button type="submit" class="btn btn-info">添加新主题</button>
                        </div>
                    {% endif %}
                </div>
            </form>
        </div>
    </div>
</section>