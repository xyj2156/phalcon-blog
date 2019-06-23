<div class="subject-header card rounded-0 mb-3">
    <div class="card-body">
        <h4 class="card-title">{{ subjectName }}</h4>
        <p class="card-text text-muted">{{ subjectDescription }}</p>
        <hr>
        <p class="mb-0 text-muted">
            当前共有 {{ total }} 篇文章
            <a href="{{ url.get({'for':'subject', 'params':parent}) }}" class="btn btn-sm btn-outline-dark float-right">
                <i class="fa fa-rotate-left"></i>
                返回上级
            </a>
        </p>
    </div>
</div>

<div class="subject-detail-body list-group">
    {% for post in posts %}
        <a href="{{ post.guid }}"
           class="list-group-item list-group-item-action flex-column align-items-start rounded-0">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="subject-detail-title mb-1">{{ post.post_title }}</h5>
                {#                <small>{{ post.post_date|strtotime|date('Y-m-d H:i') }}</small>#}
                <small>{{ post.post_date }}</small>
            </div>
            <p class="mb-1"><?= articleExcerpt($post['post_html_content'], 150) ?></p>
            <small>{{ post.view_count }} 阅读，{{ post.comment_count }} 评论</small>
        </a>
    {% endfor %}
</div>