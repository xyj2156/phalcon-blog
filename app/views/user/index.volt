<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'用户列表','_2title':'以下为所有用户'}) }}


<!-- 主内容 -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">user</h3>

                    <div class="box-tools">
                        <form action="{{ url.get('admin/user') }}" method="POST">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input
                                        type="text"
                                        name="user_search"
                                        class="form-control pull-right"
                                        placeholder="搜索"
                                        value="{{ userSearch }}"
                                >
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>注册时间</th>
                            <th>状态</th>
                        </tr>
                        {% for v in pager.getIterator() %}
                            <tr>
                                <td>{{ v.ID }}</td>
                                <td>{{ v.user_login }}</td>
                                <td>{{ v.user_email }}</td>
                                <td>{{ v.user_registered }}</td>
                                <td>
                                    <span class="label
                                    {% if v.user_status == 0 %}
                                        label-success
                                    {% elseif v.user_status == 1 %}
                                        label-warning
                                    {% elseif v.user_status == 2 %}
                                        label-danger
                                    {% endif %}
                                    ">
                                        {% if v.user_status == 0 %}
                                            正常
                                        {% elseif v.user_status == 1 %}
                                            冻结
                                        {% elseif v.user_status == 2 %}
                                            失效
                                        {% endif %}
                                    </span>
                                </td>
                            </tr>
                        {% endfor %}
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

