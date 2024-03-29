<div class="container">
    <div class="row">
        <div class="main-contain col-12 col-md-9">
            <!-- 加载主内容 -->
            {{ content() }}
        </div>
        <div class="right-sidebar d-none d-md-block col-3">
            {{ partial("shared/top-sidebar") }}

            <div class="sidebar sticky-sidebar">
                <div class="widget widget-toc d-block clearfix">
                    <h4 class="mb-1">
                        <span><i class="fa fa-bookmark-o"></i>&nbsp;目录</span>
                    </h4>
                    <div id="custom-toc-container"
                         class="markdown-body editormd-preview-container p-0">{{ post['toc'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>