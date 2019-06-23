<div class="row no-gutters">
    {% if posts.count() %}
        {% for post in posts %}
            {% if post.cover_picture is not empty %}
                <div class="article-card article-img-card col-12 p-3"
                     onclick="window.open('{{ post.post_url }}', '_self')">
                    <div class="article-card-body">
                        <div class=
                             "row no-gutters">
                            <div class="article-card-img col-xs-12 text-xs-center col-md-3 m-auto">
                                {# 展示图片 #}
                                {{ image(post.cover_picture,
                                    'class':'img-thumbnail img-fluid mx-auto d-block',
                                    'alt':post.post_title,
                                    'height':'170',
                                    'width':'170'
                                ) }}
                            </div>
                            <div class="article-card-body col-xs-12 col-md-9 m-auto">
                                <h4 class="card-title mb-2">
                                    <a href="{{ post.post_url }}">{{ post.post_title }}</a>
                                </h4>

                                <p class="card-subtitle mb-2 text-muted">
                                    <i class="fa fa-calendar-check-o"></i> {{ post.post_date }}
                                    &nbsp;&nbsp;
                                    <i class="fa fa-tags"></i>
                                    {# 处理 分类展示 #}
                                    {% if taxonomy[post.post_id]['category'] is defined %}
                                        {% for item in taxonomy[post.post_id]['category'] %}
                                            <a href="{{ url.get({'for':'index-category', 'params':item['slug']}) }}">{{ item['name'] }}</a>
                                        {% endfor %}
                                    {% endif %}
                                    &nbsp;
                                    <i class="fa fa-eye"></i> {{ post.view_count }} 阅读
                                    &nbsp;
                                    <i class="fa fa-comments-o"></i> {{ post.comment_count }}条回复
                                </p>

                                <p class="card-text"><?= articleExcerpt($post['post_content']) ?></p>

                                {# 处理标签展示 #}
                                {% if taxonomy[post['post_id']]['tag'] is defined %}
                                    <ul class="tags p-0 pl-2 mt-2">
                                        {% for item in taxonomy[post['post_id']]['tag'] %}
                                            <li class="mr-3">
                                                <a class="tag"
                                                   href="{{ url.get({'for':'index-tag', 'params':item['slug']}) }}">
                                                    <span>{{ item['name'] }}</span>
                                                </a>
                                            </li>
                                        {% endfor %}
                                    </ul>
                                {% endif %}
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <div class="article-card article-word-card col-12 p-3"
                     onclick="window.open('{{ post.post_url }}', '_self')">
                    <div class="article-card-body">
                        <h4 class="card-title mb-2">
                            <a href="{{ post.post_url }}">{{ post.post_title }}</a>
                        </h4>
                        <p class="card-subtitle mb-2 text-muted">
                            <i class="fa fa-calendar-check-o"></i> {{ post.post_date }}
                            &nbsp;&nbsp;
                            <i class="fa fa-tags"></i>
                            {# 处理 分类展示 #}
                            {% if taxonomy[post.post_id]['category'] is defined %}
                                {% for item in taxonomy[post.post_id]['category'] %}
                                    <a href="{{ url.get({'for':'index-category', 'params':item['slug']}) }}">{{ item['name'] }}</a>
                                {% endfor %}
                            {% endif %}
                            &nbsp;
                            <i class="fa fa-eye"></i> <?= $post['view_count'] ?> 阅读
                            &nbsp;
                            <i class="fa fa-comments-o"></i> {{ post.comment_count }}条回复
                        </p>

                        <p class="card-text"><?= articleExcerpt($post['post_content']) ?></p>
                    </div>

                    <div class="card-bottom">
                        {# 处理标签展示 #}
                        {% if taxonomy[post['post_id']]['tag'] is defined %}
                            <ul class="tags p-0 pl-2 mt-2">
                                {% for item in taxonomy[post['post_id']]['tag'] %}
                                    <li class="mr-3">
                                        <a class="tag"
                                           href="{{ url.get({'for':'index-tag', 'params':item['slug']}) }}">
                                            <span>{{ item['name'] }}</span>
                                        </a>
                                    </li>
                                {% endfor %}
                            </ul>
                        {% endif %}
                    </div>
                </div>
            {% endif %}
        {% endfor %}

    {% else %}
        <div class="col-12">
            <span>无</span>
        </div>
    {% endif %}

    {% if page is defined %}
        <div class="col-12">
            <nav aria-label="Page navigation">
                {{ page }}
            </nav>
        </div>
    {% endif %}
</div>