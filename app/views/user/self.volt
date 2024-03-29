<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'个人资料','_2title':'我的个人资料'}) }}


<!-- 主内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default" style="padding: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title">个人信息</h3>
                </div>

                <form class="form-horizontal" action="{{ url.get('admin/user/updateInfo') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" id="username"
                                       value="{{ user_login }}" disabled>
                                <span class="help-block">登录用户名，无法更改。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nickname" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-10">
                                <input type="text" name="nickname" class="form-control" id="nickname"
                                       value="{{ user_nickname }}">
                                <span class="help-block">您的称呼。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">展示名称</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="displayName">
                                    <option
                                            value="{{ user_nickname }}"
                                            {% if display_name == user_nickname %}selected{% endif %}
                                    >
                                        {{ user_nickname }}
                                    </option>
                                    {% if user_login != user_nickname %}
                                        <option
                                                value="{{ user_login }}"
                                                {% if display_name == user_login %}selected{% endif %}
                                        >
                                            {{ user_login }}
                                        </option>
                                    {% endif %}
                                </select>
                                <span class="help-block">您的个人邮箱，将用来通信或获取Gravatar头像。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email（必须）</label>

                            <div class="col-sm-10">
                                <input type="email" name="inputEmail" class="form-control" id="inputEmail"
                                       placeholder="Email" value="{{ user_email }}">
                                <span class="help-block">您的个人邮箱，将用来通信或获取Gravatar头像。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSite" class="col-sm-2 control-label">站点</label>

                            <div class="col-sm-10">
                                <input type="text" name="inputSite" class="form-control" id="inputSite"
                                       placeholder="http://......" value="{{ user_url }}">
                                <span class="help-block">您的个人站点，或链接。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="col-sm-2 control-label">个人说明</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="desc" rows="3" placeholder="写一点东西吧..."
                                          name="description">{{ description }}</textarea>
                                <span class="help-block">关于您的一些信息,介绍。可能会被展示在主题页面中。</span>
                            </div>

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">确定</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">密码重置</h3>
                </div>

                <form
                        class="form-horizontal"
                        action="{{ url.get('admin/user/updatePassword') }}"
                        method="post"
                >
                    <div class="box-body" style="padding: 10px;">
                        <br>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">输入旧密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">
                                <span class="help-block">输入旧密码。</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">输入新密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="inputPassword" class="form-control" id="inputPassword"
                                       placeholder="Password">
                                <span class="help-block">输入密码。</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword2" class="col-sm-2 control-label">再次输入新密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="inputPassword2" class="form-control" id="inputPassword2"
                                       placeholder="Password">
                                <span class="help-block">再次输入新密码。</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">确定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>