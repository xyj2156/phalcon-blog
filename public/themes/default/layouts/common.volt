<div class="container">
    <div class="row">
        <div class="main-contain col-12 col-md-9">
            <!-- 加载主内容 -->
            {{ content() }}
        </div>
        <div class="right-sidebar d-none d-md-block col-3">
            {{ partial("shared/top-sidebar") }}
            {{ partial("shared/sticky-sidebar") }}
        </div>
    </div>
</div>