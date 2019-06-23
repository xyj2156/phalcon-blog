<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    {{ get_title() }}
    <meta name="description" content="{{ coverDescription|default(siteDescription) }}">
    <meta name="keywords" content="{{ coverKeywords|default(siteKeywords) }}"/>
    {{ tag.tagHtml('link', {'rel':'icon', 'href':'/favicon.ico'}) }}
    <!-- 静态资源开始 -->
    {{ assets.outputCss() }}
    <!-- 静态资源结束 -->

</head>
<body class="d-flex flex-column">
<!-- 加载header -->
{{ partial('shared/header') }}

<!-- 加载common模块 -->
<div class="content col-12 flex-grow">
    {{ content() }}
</div>

<!-- 加载footer -->
<footer class="footer col-12">
    {{ partial('shared/footer') }}
</footer>
{{ assets.outputJs() }}
</body>
</html>
