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

    <?php
    /* HTML 头部资源 */
    $this->assets->outputCss();
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-black fixed sidebar-mini">

<div class="wrapper">
    <!-- 加载顶部和侧栏 -->
    <?php $this->partial("shared/header"); ?>

    <!-- 加载主模块 -->
    <div class="content-wrapper">
        <?php echo $this->getContent(); ?>
    </div>

    <!-- 加载footer -->
    <?php $this->partial("shared/footer"); ?>
</div>

<?php
/* HTML尾部资源 */
$this->assets->outputJs();
?>

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
</body>
</html>
