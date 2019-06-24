{# 共用的表格 #}
<div class="col-md-8">
    <div class="box box-default box-solid">
        <div class="box-header">
            <h3 class="box-title">{{ table_title }}{#链接分类目录#}</h3>
        </div>

        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>描述</th>
                    <th>别名</th>
                    <th>总数</th>
                </tr>
                </thead>
                <tbody>
                {% if pager is empty %}
                    <tr align="center">
                        <td colspan="4"> 暂无数据</td>
                    </tr>
                {% else %}
                    {% for item in pager.getIterator() %}
                        <tr>
                            <td>
                                <a href="{{ url.get({'for':'edit-taxonomy','type':type, 'id':item['term_taxonomy_id']}) }}">
                                    {{ item['name'] }}
                                </a>
                            </td>
                            <td>{{ item['description'] }}</td>
                            <td>{{ item['slug'] }}</td>
                            <td>{{ item['count'] }}</td>
                        </tr>
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