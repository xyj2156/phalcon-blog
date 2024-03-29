<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'阅读设置','_2title':'文章展示、抓取相关配置'}) }}


<!-- 主内容 -->
<section class="content">
    <div class="box box-default  box-solid">
        <form class="form-horizontal" action="{{ url.get("admin/setting/saveReading") }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">首页显示</label>

                    <div class="col-sm-4">
                        <div class="radio">
                            <p>
                                <label>
                                    <input name="show_on_front"
                                           type="radio"
                                           value="posts"
                                           {% if show_on_front == 'posts' %}checked{% endif %}
                                    >
                                    您的最新文章
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input
                                            name="show_on_front"
                                            type="radio"
                                            value="page"
                                            {% if show_on_front == 'page' %}checked{% endif %}
                                    >
                                    一个静态页面
                                </label>
                                <select id="show_on_front_page" name="show_on_front_page">
                                    <option
                                            value="0"
                                            {% if show_on_front_page == 0 %}selected{% endif %}
                                    >
                                        —选择—
                                    </option>
                                    {% for page in pageList %}
                                        <option
                                                value="{{ page['ID'] }}"
                                                {% if show_on_front_page == page['ID'] %}selected{% endif %}
                                        >
                                            {{ page['post_title'] }}
                                        </option>
                                    {% endfor %}
                                </select>
                            </p>
                            <span class="help-block">首页要显示的内容。</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">博客页面至多显示</label>

                    <div class="col-sm-3">
                        <input
                                name="posts_per_page"
                                class="form-control-sm"
                                step="1" min="1"
                                id="posts_per_page"
                                value="{{ posts_per_page }}"
                                type="number"
                        >
                        篇文章
                        <span class="help-block">超出时将放到下一页</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">启用 XML 站点地图</label>

                    <div class="col-sm-4">
                        <label>
                            <input
                                    name="open_XML"
                                    type="radio"
                                    value="1"
                                    {% if open_XML == 1 %}checked{% endif %}
                            >
                            是
                        </label>&nbsp;&nbsp;&nbsp;
                        <label>
                            <input
                                    name="open_XML"
                                    type="radio"
                                    value="0"
                                    {% if open_XML == 0 %}checked{% endif %}
                            >
                            否
                        </label>
                        <span class="help-block">是否启用XML站点地图。</span>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>
</section>

