<!-- 页头 -->
{{ partial('layouts/content_header', [
    '_1title' : ((linkInfo is defined) ? '编辑链接' : '新链接'),
    '_2title' : ((linkInfo is defined) ? linkInfo.link_name : '添加一个新的链接')
]) }}


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal"
                  action="{% if linkInfo is defined %}{{ url.get({'for':'update-link', 'id':linkInfo.link_id}) }}{% else %}{{ url.get({'for':'link.store'}) }}{% endif %}"
                  method="post">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{% if linkInfo is defined %}编辑{% else %}新{% endif %}链接信息</h3>
                    </div>

                    <div class="box-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="inputUser" class="col-sm-2 control-label">名称<span
                                            class="text-red"> * </span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="link_name" class="form-control" id="name" placeholder="名称"
                                           autocomplete="off" value="{{ linkInfo.link_name|default('') }}">
                                    <span class="help-block">链接的名称，例如：ZPhal官方网站。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Web地址<span
                                            class="text-red"> * </span></label>
                                <div class="col-sm-6">
                                    <input type="url" name="link_url" class="form-control" id="url" placeholder="Web地址"
                                           autocomplete="on" value="{{ linkInfo.link_url|default('') }}">
                                    <span class="help-block">例如：http://www.zphal.com/；不要忘了 http:// 或 https:// 。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-8">
                                    <input type="text" name="link_description" class="form-control" id="description"
                                           placeholder="描述" autocomplete="on"
                                           value="{{ linkInfo.link_description|default('') }}">
                                    <span class="help-block">简短的描述。例如：高效快速的博客CMS，为性能而开发。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">分类目录</label>
                                <div class="col-sm-8">
                                    <div id="link-catergory" class="form-control-static"
                                         style="max-height:200px; overflow:auto">
                                        <ul id="link-catergory-ul" style="list-style-type:none;">
                                            {% if linkCatefory is not empty %}
                                                {% for cate in linkCatefory %}
                                                    <li id="link-category-<?= $cate['term_taxonomy_id'] ?>">
                                                        <label for="in-link-category-<?= $cate['term_taxonomy_id'] ?>">
                                                            <input value="{{ cate['term_taxonomy_id'] }}<"
                                                                   name="link_category[]"
                                                                   id="in-link-category-{{ cate['term_taxonomy_id'] }}"
                                                                   type="checkbox">
                                                            {{ cate['name'] }}
                                                        </label>
                                                    </li>
                                                {% endfor %}
                                            {% endif %}
                                        </ul>
                                    </div>
                                    <span class="help-block">选择对应的分类目录；可不选。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">打开方式</label>
                                <div class="col-sm-8">
                                    <fieldset class="form-control-static">
                                        <p><label for="link_target_blank" class="selectit">
                                                <input id="link_target_blank" name="link_target" value="_blank"
                                                       type="radio"
                                                       {% if linkInfo['link_target'] is not defined %}checked{% endif %}
                                                        {% if linkInfo['link_target'] is defined and linkInfo['link_target'] == '_blank' %}checked{% endif %}
                                                >
                                                <code>_blank</code> — 新窗口或新标签。
                                            </label></p>
                                        <p><label for="link_target_top" class="selectit">
                                                <input id="link_target_top" name="link_target" value="_top"
                                                       type="radio"
                                                       {% if linkInfo['link_target'] is defined and linkInfo['link_target'] == '_top' %}checked{% endif %}
                                                >
                                                <code>_top</code> — 不包含框架的当前窗口或标签。
                                            </label></p>
                                        <p><label for="link_target_none" class="selectit">
                                                <input id="link_target_none" name="link_target" value=""
                                                       type="radio"
                                                       {% if linkInfo['link_target'] is defined and linkInfo['link_target'] === '' %}checked{% endif %}
                                                >
                                                <code>_none</code> — 同一窗口或标签。
                                            </label></p>
                                    </fieldset>
                                    <span class="help-block">为链接选择目标框架。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">图像地址</label>
                                <div class="col-sm-6">
                                    <input type="text" name="link_image" class="form-control" id="link_image"
                                           placeholder="图像地址" autocomplete="on"
                                           value="{{ linkInfo['link_image']|default('') }}">
                                    <span class="help-block">链接相关的图片，可能用于展示。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">RSS地址</label>
                                <div class="col-sm-6">
                                    <input type="text" name="link_rss" class="form-control" id="link_rss"
                                           placeholder="RSS地址" autocomplete="on"
                                           value="{{ linkInfo['link_rss']|default('') }}">
                                    <span class="help-block">该链接的RSS地址。</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">备注</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" id="link_notes" rows="3" placeholder="写一点东西吧..."
                                              name="link_notes"
                                              autocomplete="on">{{ linkInfo['link_notes']|default('') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">私密性</label>
                                <div class="col-sm-8">
                                    <fieldset class="form-control-static">
                                        <label for="link_visible_show">
                                            <input id="link_visible_show" name="link_visible" value="Y"
                                                   type="radio"
                                                   {% if linkInfo is not defined %}checked{% endif %}
                                                    {% if linkInfo is defined and linkInfo['link_visible'] == 'Y' %}checked{% endif %}
                                            >公开链接
                                        </label>
                                        <label for="link_visible_hide">
                                            <input id="link_visible_hide" name="link_visible" value="N"
                                                   type="radio"
                                                   {% if linkInfo['link_visible'] is defined and linkInfo['link_visible'] == 'N' %}checked{% endif %}
                                            >私密链接
                                        </label>
                                    </fieldset>
                                    <span class="help-block">是否公开访问。</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer  text-center">
                        <button type="submit" class="btn btn-info">确定修改</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="reset" class="btn btn-default">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>