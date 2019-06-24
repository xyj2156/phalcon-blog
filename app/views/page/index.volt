<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '页面']) }}


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills " role="tablist">
                <li role="presentation" class="{% if activeShow == 'all' %}bg-gray-active{% endif %}">
                    <a href="{{ url.get({'for':'list-page','params':'all'}) }}">全部 <span
                                class="badge">{{ static['publish_num'] + static['draft_num'] }}</span></a>
                </li>
                <li role="presentation" class="{% if activeShow == 'publish' %}bg-gray-active{% endif %}">
                    <a href="{{ url.get({'for':'list-page','params':'publish'}) }}">已发布 <span
                                class="badge">{{ static['publish_num'] }}</span></a>
                </li>
                <li role="presentation" class="{% if activeShow == 'draft' %}bg-gray-active{% endif %}">
                    <a href="{{ url.get({'for':'list-page','params':'draft'}) }}">草稿 <span
                                class="badge">{{ static['draft_num'] }}</span></a>
                </li>
                <li role="presentation" class="{% if activeShow == 'trash' %}bg-gray-active{% endif %}">
                    <a href="{{ url.get({'for':'list-page','params':'trash'}) }}">回收站 <span
                                class="badge">{{ static['trash_num'] }}</span></a>
                </li>
            </ul>
        </div>

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{ url.get({'for':'list-page','params':activeShow}) }}"
                          method="get">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <select class="form-control">
                                        <option>批量操作</option>
                                        <option>移至回收站</option>
                                    </select>
                                    <div class="input-group-btn">
                                        <button id="add-new-event" type="button" class="btn btn-default btn-flat">应用
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-xs-3 col-xs-offset-1">
                                        <div class="input-group">
                                            <select class="form-control" name="dateSelected">
                                                <option value="0">全部日期</option>
                                                {% for date in dateSection if date['year_month'] != '1000-01' %}
                                                    <option
                                                            {% if dateSelected == date['year_month'] %}selected{% endif %}
                                                            value="{{ date['year_month'] }}">
                                                        {{ date['year_month'] }}
                                                    </option>
                                                {% endfor %}
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
                                    <input type="text"
                                           name="search"
                                           class="form-control pull-right"
                                           placeholder="标题关键字"
                                           value="{{ search|default('') }}">
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
                            <th width="25%">标题</th>
                            <th width="5%">作者</th>
                            <th width="5%">评论 <i class="fa fa-comment"></i></th>
                            <th width="10%">日期</th>
                            <th width="5%">阅读量</th>
                            <th width="20%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {% if pager.getIterator()|length %}
                            {% for k,v in pager.getIterator() %}
                                <tr>
                                    <td>
                                        {% if v.post_status == 'publish' %}
                                            <a href="{{ url.get({'for':'edit-page','id':v.ID}) }}">{{ v.post_title }}</a>
                                        {% elseif v.post_status == 'draft' %}
                                            <a href="{{ url.get({'for':'edit-page','id':v.ID}) }}">{{ v.post_title }}</a> — 草稿
                                        {% elseif v.post_status == 'trash' %}
                                            {{ v.post_title }}
                                        {% endif %}
                                    </td>
                                    <td>{{ v.display_name }}</td>
                                    <td>
                                        {% if v.comment_count > 0 %}
                                            {{ v.comment_count }}<a href=""><i class="fa fa-commenting"></i></a>
                                        {% else %}
                                            {{ v.comment_count }}
                                        {% endif %}
                                    </td>
                                    <td>
                                        {% if v.post_date == '1000-01-01 00:00:00' %}
                                            尚未发布
                                        {% else %}
                                            {{ v.post_date }}
                                        {% endif %}
                                    </td>
                                    <td>{{ v.view_count }}</td>
                                    <td>
                                        {% if v.post_status != 'trash' %}
                                            <a href="{{ url.get({'for':'edit-page','id':v.ID}) }}"
                                               class="btn btn-xs bg-purple"><i
                                                        class="fa fa-edit"></i> 编辑</a>
                                            <a class="btn btn-xs btn-danger common-bind-model" data-toggle="modal"
                                               data-target="#trash_modal" data-replace="__id" data-id="{{ v.ID }}"><i
                                                        class="fa fa-trash-o"></i>
                                                移到回收站</a>
                                        {% else %}
                                            <a href="{{ url.get({'for':'restore-page', 'id':v.ID}) }}"
                                               class="btn btn-xs btn-warning"><i class="fa fa-trash-o"></i> 还原</a>
                                            <a class="btn btn-xs btn-danger common-bind-model" data-toggle="modal"
                                               data-target="#delete_modal" data-id="{{ v.ID }}" data-replace="__id"><i
                                                        class="fa fa-trash-o"></i>
                                                永久删除</a>
                                        {% endif %}
                                    </td>
                                </tr>
                            {% endfor %}
                        {% else %}
                            <tr>
                                <td colspan="8" class="text-center">无</td>
                            </tr>
                        {% endif %}
                        </tbody>
                    </table>
                </div>

                <div class="box-footer clearfix">
                    {% if pager.haveToPaginate() %}
                        {{ pager.getLayout() }}
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal modal-danger fade" id="trash_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">移到回收站</h4>
            </div>
            <div class="modal-body">
                <p>确定要移到回收站吗？已发布的文章将不再展示&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left"
                        data-dismiss="modal">取消
                </button>
                <a href="{{ url.get({'for':'trash-page','id':'__id'}) }}" type="button" class="btn btn-outline">确定</a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger fade" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">永久删除</h4>
            </div>
            <div class="modal-body">
                <p>确定要永久删除吗？永久删除将无法回复&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left"
                        data-dismiss="modal">取消
                </button>
                <a href="{{ url.get({'for':'delete-page','id':'__id'}) }}" type="button" class="btn btn-outline">确定</a>
            </div>
        </div>
    </div>
</div>