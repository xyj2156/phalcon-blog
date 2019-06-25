<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'专题管理','_2title':'专题是文章、页面等的整合板块'}) }}


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default box-solid">
                <div class="box-header">
                    <h3 class="box-title">专题列表</h3>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>描述</th>
                            <th>别名</th>
                            <th>上次更新</th>
                            <th>总数</th>
                        </tr>
                        </thead>
                        <tbody>
                        {% if pager|length == 0 %}
                            <tr align="center">
                                <td colspan="4"> 暂无数据</td>
                            </tr>
                        {% else %}
                            {% for item in pager.getIterator() %}
                                {{ item['html'] }}
                            {% endfor %}
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