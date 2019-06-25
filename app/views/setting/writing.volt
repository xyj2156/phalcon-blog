<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'撰写设置','_2title':'文章相关配置'}) }}


<!-- 主内容 -->
<section class="content">
    <div class="box box-default  box-solid">
        <form class="form-horizontal" action="{{ url.get('admin/setting/saveWriting') }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">默认文章分类目录</label>

                    <div class="col-sm-2">
                        <select class="form-control" name="default_category">
                            {{ categoryTree }}
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">默认链接分类目录</label>

                    <div class="col-sm-2">
                        <select class="form-control" name="default_link_category">
                            <option value="0">无</option>
                            {% for category in linkCategory %}
                                <option
                                        value="{{ category['term_taxonomy_id'] }}"
                                        {% if category['term_taxonomy_id'] == default_link_category %}selected{% endif %}
                                >
                                    {{ category['name'] }}
                                </option>
                            {% endfor %}
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>
</section>

