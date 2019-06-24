<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- title -->
    {{ get_title() }}

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ url.get('backend/img/favicon.ico') }}">

    {{ stylesheet_link('backend/library/bootstrap/css/bootstrap.min.css') }}
    {{ stylesheet_link('backend/library/font-awesome/css/font-awesome.min.css') }}
    {{ stylesheet_link('backend/library/Ionicons/css/ionicons.min.css') }}
    {{ stylesheet_link('backend/library/AdminLTE/css/AdminLTE-without-plugins.min.css') }}
    {{ stylesheet_link('backend/plugins/iCheck/square/blue.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page" style="height: auto">
<div class="login-box">
    <div class="login-logo">
        {{ image('backend/img/logo-gray.png','alt':'Json-blog') }}
    </div>

    <div class="msgTip">
        {{ flash.output() }}
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">登录</p>
        <form action="{{ url.get("admin/session/login") }}" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="user" class="form-control" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="{{ security.getTokenKey() }}"
                       value="{{ security.getToken() }}"/>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox iCheck">
                        <label>
                            <input type="checkbox"> 记住我
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
            </div>
        </form>
        <br>
        <div>
            <a href="#" style="color: #9d9d9d"><i class="fa fa-key"></i> 忘记密码</a>
            <a href="register" class="right" style="float: right; color: #9d9d9d"><i class="fa fa-leaf"></i>
                注册用户</a>
        </div>
    </div>
</div>

{{ javascript_include('backend/js/jquery.min.js') }}
{{ javascript_include('backend/library/bootstrap/js/bootstrap.min.js') }}
{{ javascript_include('backend/plugins/iCheck/icheck.min.js') }}

</body>
</html>
