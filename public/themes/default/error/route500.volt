<div class="row">
    <div class="col-md-12">
        <div class="error-v4">
            <div class="col-md-12 text-center error-banner">
                <h1>{{ code|default('500') }}</h1>
            </div>

            <div class="col-md-12 text-center">
                <p class="lead">
                    {{ message|default('服务暂时无法处理这个请求') }}
                </p>
                <p>
                    <a class="btn btn-sm btn-primary" href="/" style="color: #fff;">返回首页</a>
                </p>
            </div>
        </div>
    </div>
</div>