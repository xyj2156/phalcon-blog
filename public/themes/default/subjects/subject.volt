{% if self is not empty %}
    <div class="subject-header card rounded-0 mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ self['subject_name'] }}</h4>
            <p class="card-text text-muted">{{ self['subject_description'] }}
                <a href="{{ url.get({'for':'subject', 'params':self['parent']}) }}"
                   class="btn btn-sm btn-outline-dark card-link float-right">
                    <i class="fa fa-rotate-left"></i> 返回上级
                </a>
            </p>
        </div>
    </div>
{% endif %}

<div class="subject-body card-columns">
    {% for subject in subjects %}
        <div class="card rounded-0 text-center">
            {{ image(subject.subject_image,
                'class': 'card-img-top d-block rounded-0',
                'alt': subject.subject_slug,
                'height' : 180) }}
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ subject.link }}">{{ subject.subject_name }}</a>
                </h4>
                <p class="card-subtitle mb-2 text-muted">{{ subject.count }} 篇文章</p>
                <p class="card-text">{{ subject.subject_description }}</p>
                <a href="{{ subject.link }}" class="card-button btn btn-sm btn-outline-primary">查看专题</a>
            </div>
            <div class="card-footer text-muted">
                {{ subject.last_updated }} 更新
            </div>
        </div>
    {% endfor %}
</div>