<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '讨论设置','_2title':'评论、评论展示相关配置']) }}


<!-- 主内容 -->
<section class="content">
    <div class="box box-default  box-solid">
        <form class="form-horizontal" action="{{ url.get('admin/setting/saveDiscuss') }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">是否开启评论</label>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label><input type="checkbox" name="post_comment_status"
                                          value="1" {% if post_comment_status == 'open' %}checked{% endif %}>文章</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><input type="checkbox" name="page_comment_status"
                                          value="1" {% if page_comment_status == 'open' %}checked{% endif %}>页面</label>
                            <span class="help-block">开启评论功能让用户进行评论。</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">评论设置</label>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="checkbox">
                                <div class="col-sm-12">
                                    <label>
                                        <input name="comment_need_register"
                                               value="1"
                                               type="checkbox"
                                               {% if comment_need_register == 1 %}checked{% endif %}
                                        >
                                        用户必须注册并登录才可以发表评论
                                    </label>
                                </div>
                                <div class="col-sm-12">
                                    <label>
                                        <input
                                                name="show_comment_page"
                                                value="1"
                                                type="checkbox"
                                                {% if show_comment_page == 1 %}checked{% endif %}
                                        >分页显示评论，
                                    </label>
                                    每页显示
                                    <select name="comment_per_page">
                                        <option value="5"
                                                {% if comment_per_page == 5 %}selected{% endif %}
                                        >
                                            5
                                        </option>
                                        <option value="10"
                                                {% if comment_per_page == 10 %}selected{% endif %}
                                        >
                                            10
                                        </option>
                                        <option value="15"
                                                {% if comment_per_page == 15 %}selected{% endif %}
                                        >
                                            15
                                        </option>
                                        <option value="20"
                                                {% if comment_per_page == 20 %}selected{% endif %}
                                        >
                                            20
                                        </option>
                                        <option value="25"
                                                {% if comment_per_page == 25 %}selected{% endif %}
                                        >
                                            25
                                        </option>
                                    </select>
                                    条评论，默认显示
                                    <select name="comment_page_first">
                                        <option value="last"
                                                {% if comment_page_first == 'last' %}selected{% endif %}
                                        >
                                            最后
                                        </option>
                                        <option value="front"
                                                {% if comment_page_first == 'front' %}selected{% endif %}
                                        >
                                            最前
                                        </option>
                                    </select>
                                    一页
                                </div>
                                <div class="col-sm-12">
                                    在每个页面顶部显示
                                    <select name="comment_page_top">
                                        <option value="old"
                                                {% if comment_page_top == 'old' %}selected{% endif %}
                                        >
                                            旧的
                                        </option>
                                        <option value="new"
                                                {% if comment_page_top == 'new' %}selected{% endif %}
                                        >
                                            新的
                                        </option>
                                    </select>
                                    评论
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">在评论显示之前</label>

                    <div class="col-sm-4">
                        <label>
                            <input name="comment_before_show"
                                   value="must_approve"
                                   type="radio"
                                   {% if comment_before_show == 'must_approve' %}checked{% endif %}
                            >
                            评论必须经人工批准
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input name="comment_before_show"
                                   value="approve_before"
                                   type="radio"
                                   {% if comment_before_show == 'approve_before' %}checked{% endif %}
                            >
                            评论者先前须有评论通过了审核
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input name="comment_before_show"
                                   value="directly"
                                   type="radio"
                                   {% if comment_before_show == 'directly' %}checked{% endif %}
                            >
                            直接显示
                        </label>
                        <span class="help-block">评论展示条件。</span>
                    </div>
                </div>

                <div class="form-group">
                    <h4 class="col-sm-2 control-label"><b>头像</b></h4>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">头像显示</label>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                <input name="show_avatar"
                                       type="checkbox"
                                       value="1"
                                       {% if show_avatar == 1 %}checked{% endif %}
                                >
                                显示头像
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>
</section>

