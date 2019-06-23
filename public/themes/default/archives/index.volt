<div class="archives-body card rounded-0">
    <div class="card-header text-white bg-dark rounded-0">
        <h4 class="m-auto"><i class="fa fa-file-o"></i> 归档</h4>
    </div>
    {% if list is empty %}
        <div class="card-body">
            暂无文章
        </div>
    {% else %}
        <ul class="list-group" id="archives">
            {% for yearKey,year in list %}
                <li class="list-group-item border-0">
                    <h4 class="font-weight-bold mb-2">{{ yearKey }}年</h4>
                    <ul class="list-group">
                        {% for monthKey,month in year %}
                            <li class="list-group-item archive-month border border-1">
                                <h5 class="mb-2"><span class="font-weight-bold ml-3">{{ monthKey }} 月</span>
                                    <small class="float-right text-muted">{{ month|length }} 篇文章</small>
                                </h5>
                                <ul class="list-group list-group-flush month_items">
                                    {% for day in month %}
                                        <li class="list-group-item">
                                            <span>{{ day['theDay'] }} 日：</span>
                                            <a href="{{ day['guid'] }}">{{ day['post_title'] }}</a>
                                            <span class="badge badge-primary d-flex float-right">{{ day['comment_count'] }}</span>
                                        </li>
                                    {% endfor %}
                                </ul>
                            </li>
                        {% endfor %}
                    </ul>
                </li>
            {% endfor %}
        </ul>
    {% endif %}
</div>

