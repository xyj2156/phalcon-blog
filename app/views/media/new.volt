<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '上传新媒体文件']) }}

<!-- 主内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <label for="input-fa">选择文件</label>
                <div class="file-loading">
                    <input id="input-fa" name="input-fa[]" type="file" multiple>
                </div>
            </form>
        </div>
    </div>
</section>