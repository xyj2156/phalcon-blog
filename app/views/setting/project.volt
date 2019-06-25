<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '作品','_2title':'设置要展示的作品（Github）']) }}


<!-- 主内容 -->
<section class="content">
    <div class="box box-default box-solid">
        <form class="form-horizontal" action="{{ url.get('admin/setting/saveProject') }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">开启GitHub repo展示</label>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                <input
                                        name="show_project"
                                        type="radio"
                                        value="1"
                                        {% if showProject == 1 %}checked{% endif %}
                                >
                                是
                            </label>
                            <label>
                                <input
                                        name="show_project"
                                        type="radio"
                                        value="0"
                                        {% if showProject == 0 %}checked{% endif %}
                                >
                                否
                            </label>
                            <span class="help-block">是否开启GitHub repositories展示功能。</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">GitHub User</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="github_name" placeholder="github 用户名"
                               value="{{ GitHubUser }}">
                        <span class="help-block">GitHub账户的用户名</span>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>

    <div class="col-md-12 bg-gray">

        <div class="row">
            <h4 class="col-md-12">
                设置要展示的repo
                <small>将要展示的拖拽到右边</small>
            </h4>

            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">所有repos</h3>
                    </div>

                    <div class="box-body">
                        <div id="left-defaults" class="list-group">
                            {% if allRepo %}
                                {% for item in allRepo %}
                                    <div class="list-group-item">
                                        {{ item['full_name'] }}
                                        <input type="hidden" name="showRepo[]" value="{{ item['full_name'] }}">
                                    </div>
                                {% endfor %}
                            {% else %}
                                获取失败；可能超过每日获取上限。
                            {% endif %}
                        </div>
                    </div>

                </div>
            </div>

            <form class="form-horizontal" action="{{ url.get('admin/setting/saveShowRepo') }}" method="post">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">要展示的repos</h3>
                        </div>

                        <div class="box-body">
                            <div id="right-defaults" class="list-group" style="min-height: 50px">
                                {% if showRepo %}
                                    {% for item in showRepo %}
                                        <div class="list-group-item">
                                            {{ item['full_name'] }}
                                            <input type="hidden" name="showRepo[]" value="{{ item['full_name'] }}">
                                        </div>
                                    {% endfor %}
                                {% endif %}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn bg-purple" style="margin-bottom: 10px">提交</button>
                </div>
            </form>
        </div>

    </div>
</section>