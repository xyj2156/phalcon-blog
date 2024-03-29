<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '常规选项','_2title':'一些基础配置']) }}

<!-- 主内容 -->
<section class="content">

    <div class="box box-default  box-solid">
        <form class="form-horizontal" action="{{ url.get("admin/setting/saveGeneral") }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">站点标题</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="blogname" placeholder="输入站点标题"
                               value="{{ blogname }}">
                        <span class="help-block">即站点的名称</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">副标题</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="blogdescription" placeholder="副标题"
                               value="{{ blogdescription }}">
                        <span class="help-block">用简洁的文字描述本站点，用于站点副标题。</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">站点地址（URL）</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="siteurl" placeholder="输入站点的地址"
                               value="{{ siteurl }}">
                        <span class="help-block">如：https://www.blog.x-ac.cn.com</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">电子邮件地址</label>

                    <div class="col-sm-4">
                        <input type="email"
                               class="form-control"
                               name="admin_email"
                               placeholder="输入电子邮件地址"
                               value="{{ admin_email|default('506907958@qq.com') }}"
                        >
                        <span class="help-block">此地址被用作管理用途，如新用户通知。</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">开放注册</label>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                <input
                                        name="users_can_register"
                                        type="radio"
                                        {% if users_can_register == 1 %}checked{% endif %}
                                >
                                是
                            </label>
                            <label>
                                <input
                                        name="users_can_register"
                                        type="radio"
                                        value="0"
                                        {% if users_can_register == 0 %}checked{% endif %}
                                >
                                否
                            </label>
                            <span class="help-block">是否开放站点的注册功能。</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">站点语言</label>

                    <div class="col-sm-4">
                        <span class="form-control no-border">简体中文</span>
                        <span class="help-block">暂时没有国际化。</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">时区</label>

                    <div class="col-sm-2">
                        <select class="form-control" name="timezone_string">
                            <option value="Asia/Shanghai"
                                    {% if timezone_string == "Asia/Shanghai" %}selected{% endif %}
                            >
                                亚洲/上海
                            </option>
                        </select>
                        <span class="help-block">选择与您在同一时区的城市。</span>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>

</section>

