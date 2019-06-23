<div class="row">
    <div class="col-md-12">
        <div class="error-v4">
            <div class="col-md-12 text-center error-banner">
                <h1>{{ code|default('404') }}</h1>
            </div>

            <div class="col-md-12 text-center">
                <p class="lead">
                    {{ message|default('页面未找到 the page is not found') }}
                </p>
                <p>
                    <a class="btn btn-sm btn-primary" href="/" style="color: #fff;">返回首页</a>
                </p>
            </div>
        </div>
    </div>
</div>