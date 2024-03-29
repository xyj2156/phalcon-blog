<div class="row post-container bg-white no-gutters mb-3">
    <div class="col-12 post-header mt-2">
        <h1 class="post-title">{{ post.post_title }}</h1>
    </div>

    <div class="col-12 post_meta">
        <ul class="post_meta_ul list-unstyled">
            <li class="inline-li float-left mr-2">
                <i class="fa fa-calendar-check-o"></i>
                {{ post.post_date }}
            </li>
            <li class="inline-li float-left mr-2">
                <span class="post-span"> | </span>
            </li>
            <li class="inline-li float-left mr-2">
                <i class="fa fa-tags"></i>
                {{ category }}
            </li>
            <li class="inline-li float-left mr-2">
                <span class="post-span"> | </span>
            </li>
            <li class="inline-li float-left mr-2">
                <i class="fa fa-eye"></i>
                {{ post.view_count }} 阅读&nbsp;&nbsp;
            </li>

            <li class="inline-li float-left mr-2">
                <i class="fa fa-comments-o"></i>
                <a href="#comments">{{ post.comment_count }} 回复</a>
            </li>
        </ul>
    </div>

    <div id="editormd-view" class="col-12 post-content editormd">
        <div class="editormd-html-textarea markdown-body" name="editormd-view-html-code">
            {{ post.post_html_content }}
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-12 post-tags">
        <i class="fa fa-tags"></i> 标签：
        {{ tag }}
    </div>
</div>

<div class="row post-state bg-white no-gutters mb-3">
    <div class="col-12 mb-1">
        <span>
            <b><i class="fa fa-copyright" aria-hidden="true"></i>版权声明：</b>
            本站文章如无说明，则为原创。本站采用
            <i class="fa fa-lg fa-creative-commons" aria-hidden="true"></i>
            <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank">
                知识共享署名-非商业性使用-禁止演绎 4.0 国际许可协议
            </a>
            进行许可。
        </span>
    </div>
    <div class="col-12">
        <span>
            <b><i class="fa fa-link" aria-hidden="true"></i>本文链接：</b>
            <a href="{{ post.guid }}" title="{{ post.post_title }}">{{ post.guid }}</a>
        </span>
    </div>
</div>

<div class="row post-lastAndNext no-gutters mb-3">
    <div class="col-xs-12 col-sm-6 lastAndNext-left">
        <p class="float-left mb-0">
            上一篇：{{ last|default('没有了，已经是最后文章') }}
        </p>
    </div>
    <div class="col-xs-12 col-sm-6 lastAndNext-right">
        <p class="float-xs-left float-md-right mb-0">
            下一篇：{{ next|default('没有了，已经是最新文章') }}
        </p>
    </div>
</div>

<div class="bottom-tools">
    <a id="back-to-top" title="返回顶部"></a>
</div>