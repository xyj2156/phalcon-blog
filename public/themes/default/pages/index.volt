<div class="row post-container bg-white no-gutters mb-3">
    <div class="col-12 post-header">
        <h1 class="post-title">{{ post['post_title'] }}</h1>
    </div>

    <div class="col-12 post_meta">
        <ul class="post_meta_ul list-unstyled">
            <li class="inline-li float-left mr-2">
                <i class="fa fa-calendar-check-o"></i>
                {{ post['post_date'] }}
            </li>
        </ul>
    </div>

    <div id="editormd-view" class="col-12 post-content editormd">
        <div class="editormd-html-textarea markdown-body" name="editormd-view-html-code">
            {{ post['post_html_content'] }}
        </div>
    </div>
</div>