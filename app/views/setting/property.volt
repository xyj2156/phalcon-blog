<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'网站属性','_2title':'网站相关配置'}) }}

<!-- 主内容 -->
<section class="content">

    <div class="box box-default  box-solid">
        <form class="form-horizontal" action="{{ url.get({'for':'setting.saveProperty'}) }}" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">网站描述description</label>

                    <div class="col-sm-5">
                        <textarea class="form-control" rows="3" name="site_description"
                                  placeholder="meta description">{{ siteDescription|default('') }}</textarea>
                        <span class="help-block">对你的网站进行描述，将输出在站点页面 meta 的 description 中。
                        <p class="text-red">填写后尽量少修改</p></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">网站关键词keywords</label>

                    <div class="col-sm-5">
                        <textarea class="form-control" rows="3" name="site_keywords"
                                  placeholder="meta keywords">{{ siteKeywords|default('') }}</textarea>
                        <span class="help-block">网站的关键词，将输出在站点页面 meta 的 keywords 中；多个关键词请用英文逗号隔开。
                        <p class="text-red">填写后尽量少修改</p></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">底部footer版权申明</label>

                    <div class="col-sm-5">
                        <textarea class="form-control" rows="12" name="footer_copyright"
                                  placeholder="Copyright © 2017 ZPhal.">{{ footerCopyright|default('') }}</textarea>
                        <span class="help-block">网站的底部信息，将输出在站点底部；可以包含html标签。</span>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn bg-purple col-sm-offset-2">保存更改</button>
            </div>
        </form>
    </div>

</section>

