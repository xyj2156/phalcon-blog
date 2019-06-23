{% if ifShow is not empty %}
    {% if showRepos is not empty %}
        <div class="card-columns project-card-columns">
            {% for repo in shiwRepos %}
                <div class="card project-card rounded-0 border-0">
                    <div class="card-body project-body">
                        <p class="card-title project-title">
                            <a href="{{ repo['html_url'] }}" target="_blank" class="project-link">
                                {{ repo['full_name'] }}
                            </a>
                        </p>
                        <p class="card-text project-description">{{ repo['description'] }}</p>
                        <p class="card-text project-meta">
                            {% if repo['language'] is not empty %}
                                <span class="mr-3">
                                    <i class="fa fa-circle project-language-{{ repo['language'] }}"></i>
                                    {{ repo['language'] }}
                                </span>
                            {% endif %}

                            <span class="mr-3">
                                <i class="fa fa-star"></i>
                                {{ repo['watchers'] }}
                            </span>

                            <span class="mr-3">
                                <i class="fa fa-code-fork"></i>
                                {{ repo['forks'] }}
                            </span>
                        </p>
                    </div>
                </div>
            {% endfor %}
        </div>
    {% else %}
        <div>
            没有展示内容
        </div>
    {% endif %}
{% else %}
    <div>
        功能已关闭
    </div>
{% endif %}