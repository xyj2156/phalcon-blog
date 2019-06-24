<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '编辑文章','_2title':'固定链接：<span id="postUrl">'~info['guid']|default('')~'</span>']) }}


<!-- 主内容 -->
<section class="content">
    <div class="row">
        <form action="{{ url.get(info is defined ? 'admin/post/update.html' : 'admin/post/save.html') }}" method="post">
            <div class="form-group col-md-12">
                <input class="form-control" id="title" type="text" name="title" placeholder="输入标题"
                       value="{{ info['post_title']|default('') }}">
                {% if info is defined %}
                    <input type="hidden" id="post_id" name="post_id" value="{{ info['ID'] }}">
                {% endif %}
            </div>

            <div class="form-group col-md-12">
                <div id="editormd" class="editormd">
                    <textarea class="editormd-markdown-textarea"
                              name="editormd-markdown-doc">{{ info['post_content']|default('') }}</textarea>

                    <textarea class="editormd-html-textarea" name="editormd-html-code"></textarea>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description"
                          placeholder="概述">{{ description|default('') }}</textarea>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-calendar"></i> 发布</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <i class="fa fa-map-pin"></i>&nbsp;状态：&nbsp;
                                                {% if info is defined and info['post_status'] == 'publish' %}
                                                    <b id="nowStatusStr">已发布</b>
                                                    <a href="javascript:void(0)" id="changeStatus">编辑</a>
                                                {% else %}
                                                    {#                                                     elseif ($info['post_status'] == 'draft') {#}
                                                    <b>草稿</b>
                                                {% endif %}

                                                <input type="hidden" name="now_status" id="now_status"
                                                       value="{{ info['post_status']|default('') }}">
                                                <input type="hidden" id="post_date"
                                                       value="{{ info['post_date']|default('') }}">
                                            </div>

                                            {% if info is defined and info['post_status'] == 'publish' %}
                                                <div class="form-group col-md-12" id="selectStatus"
                                                     style="display: none;">
                                                    <select class="input-sm" name="change_status" id="change_status">
                                                        <option value="publish">已发布</option>
                                                        <option value="draft">草稿</option>
                                                    </select>
                                                    &nbsp;
                                                    <a href="javascript:void(0)" id="saveChangeStatus"
                                                       class="btn btn-primary btn-sm">确定</a>
                                                    <a href="javascript:void(0)" id="cancelChangeStatus"
                                                       class="btn btn-default btn-sm">取消</a>
                                                </div>
                                            {% endif %}

                                            <div class="form-group col-md-12">
                                                <!--TODO-->
                                                <i class="fa fa-eye"></i>&nbsp;公开度：&nbsp;
                                                <select class="input-sm" name="ifPublic">
                                                    <option value="open">公开</option>
                                                    <option value="password">密码访问</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <i class="fa fa-comment-o"></i>&nbsp;开启评论：&nbsp;
                                                <label>
                                                    <input type="radio"
                                                           name="ifComment"
                                                           value="yes"
                                                           {% if info is not defined %}checked{% endif %}
                                                            {% if info is defined and info['comment_status'] == 'open' %}checked{% endif %}
                                                    >
                                                    是
                                                </label>
                                                &nbsp;&nbsp;
                                                <label>
                                                    <input type="radio"
                                                           name="ifComment"
                                                           value="no"
                                                           {% if info is defined and info['comment_status'] == 'closed' %}checked{% endif %}
                                                    >
                                                    否
                                                </label>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <i class="fa fa-arrow-up"></i>&nbsp;是否置顶：&nbsp;
                                                <label>
                                                    <input type="radio" name="ifTop" value="yes"> 是
                                                </label>
                                                &nbsp;&nbsp;
                                                <label>
                                                    <input type="radio" name="ifTop" value="no" checked> 否
                                                </label>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <i class="fa fa-calendar-check-o"></i>&nbsp;发布时间：&nbsp;

                                                <b id="timestamp">
                                                    {% if info is defined and info['post_date'] != '1000-01-01 00:00:00' %}
                                                        <b>发布于 {{ info['post_date'] }}</b>
                                                    {% else %}
                                                        <b>立即发布</b>
                                                    {% endif %}
                                                </b>&nbsp;&nbsp;
                                                <a href="javascript:void(0)" id="editTimestamp">编辑</a>
                                            </div>

                                            <div class="form-group col-md-12" id="timestampDiv" style="display: none;">
                                                <label><i class="fa fa-calendar-plus-o"></i>&nbsp;日期和时间</label>
                                                {% if info is defined and info['post_status'] == 'draft' and info['post_date'] == '1000-01-01 00:00:00' %}
                                                    <input type="hidden" id="publishDate" name="publishDate"
                                                           value="now">
                                                {% else %}
                                                    <input type="hidden" id="publishDate" name="publishDate"
                                                           value="edit">
                                                {% endif %}
                                                <fieldset>
                                                    <div class="timestamp-wrap">
                                                        <label>
                                                            <input type="text" class="form-control input-sm" id="year"
                                                                   name="year"
                                                                   value="{{ publishDatetime['year']|default('') }}"
                                                                   size="3" maxlength="3" autocomplete="off">
                                                        </label>
                                                        -
                                                        <label>
                                                            <select id="month" name="month"
                                                                    class="form-control input-sm">
                                                                {% for i in 1..12 %}
                                                                    <option value="{{ i < 10 ? '0'~i : i }}"
                                                                            data-text="{{ i }}月"
                                                                            {% if publishDatetime is defined and i == publishDatetime['month'] %}selected{% endif %}
                                                                    >{{ i }}月
                                                                    </option>
                                                                {% endfor %}
                                                            </select>
                                                        </label>
                                                        -
                                                        <label>
                                                            <input type="text" id="day" name="day"
                                                                   value="{{ publishDatetime['day']|default('') }}"
                                                                   class="form-control input-sm" size="2" maxlength="2"
                                                                   autocomplete="off">
                                                        </label>
                                                        &nbsp;@&nbsp;
                                                        <label>
                                                            <input type="text" id="hour" name="hour"
                                                                   value="{{ publishDatetime['hour']|default('') }}"
                                                                   class="form-control input-sm" size="2" maxlength="2"
                                                                   autocomplete="off">
                                                        </label>
                                                        :
                                                        <label>
                                                            <input type="text" id="minute" name="minute"
                                                                   value="{{ publishDatetime['minute']|default('') }}"
                                                                   class="form-control input-sm" size="2" maxlength="2"
                                                                   autocomplete="off">
                                                        </label>
                                                    </div>

                                                    <input type="hidden" id="second" name="second"
                                                           value="{{ publishDatetime['second']|default('') }}">

                                                    <input type="hidden" id="hidden_year" name="hidden_year"
                                                           value="{{ publishDatetime['year']|default('') }}">
                                                    <input type="hidden" id="cur_year" name="cur_year">
                                                    <input type="hidden" id="hidden_month" name="hidden_month"
                                                           value="{{ publishDatetime['month']|default('') }}">
                                                    <input type="hidden" id="cur_month" name="cur_month">
                                                    <input type="hidden" id="hidden_day" name="hidden_day"
                                                           value="{{ publishDatetime['day']|default('') }}">
                                                    <input type="hidden" id="cur_day" name="cur_day">
                                                    <input type="hidden" id="hidden_hour" name="hidden_hour"
                                                           value="{{ publishDatetime['hour']|default('') }}">
                                                    <input type="hidden" id="cur_hour" name="cur_hour">
                                                    <input type="hidden" id="hidden_minute" name="hidden_minute"
                                                           value="{{ publishDatetime['minute']|default('') }}">
                                                    <input type="hidden" id="cur_minute" name="cur_minute">
                                                    <p>
                                                        <a href="javascript:void(0)" id="saveTimestamp"
                                                           class="btn btn-primary btn-sm">确定</a>
                                                        <a href="javascript:void(0)" id="cancelTimestamp"
                                                           class="btn btn-default btn-sm">取消</a>
                                                    </p>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="box-footer">
                                        <input type="hidden" id="ajaxUri" value="<?= $ajaxUri ?>">
                                        {% if info is defined %}
                                            <a class="btn btn-sm btn-danger"
                                               data-toggle="modal"
                                               data-target="#trash_modal">
                                                <i class="fa fa-trash-o"></i>
                                                移到回收站
                                            </a>
                                        {% endif %}
                                        {% if info is defined and info['post_status'] == 'publish' %}
                                            <button type="submit"
                                                    name="submitWay"
                                                    value="publish"
                                                    class="btn btn-info pull-right">
                                                更新
                                            </button>
                                        {% elseif info is not defined or info['post_status'] == 'draft' %}
                                            <div class="pull-right">
                                                <button type="submit" name="submitWay"
                                                        value="draft"
                                                        class="btn btn-default">
                                                    保存草稿
                                                </button>
                                                <button type="submit" name="submitWay"
                                                        value="publish"
                                                        class="btn btn-info">
                                                    发布
                                                </button>
                                            </div>
                                        {% endif %}

                                        <p class="margin pull-right" id="autoDraftTps" style="display: none;"></p>
                                        {% if info is defined %}
                                            <div class="modal modal-danger fade" id="trash_modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">移到回收站</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>确定要移到回收站吗？</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline pull-left"
                                                                    data-dismiss="modal">取消
                                                            </button>
                                                            <a href="{{ url.get({'for':'trash-post','id':info['ID']}) }}"
                                                               type="button" class="btn btn-outline">确定</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="box box-default">
                                    <div class="overlay" id="post_category">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-tags"></i> 分类</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>添加新分类</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <select class="form-control" id="newCategoryParent">
                                                            <?= $categoryTreeNbsp ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-7">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="newCategory"
                                                                   placeholder="分类名称">
                                                            <span class="input-group-btn">
                                                          <button type="button" id="addNewCategory"
                                                                  class="btn btn-info btn-flat">添加</button>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>选择分类</label>
                                                <select class="form-control select2" id="categoryList"
                                                        name="categories[]" multiple="multiple" data-placeholder="选择分类"
                                                        style="width: 100%;">
                                                    <?= $categoryTree ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="box box-default">
                                    <div class="overlay" id="post_tag">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-tags"></i> 标签</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>添加新标签</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="newTag"
                                                           placeholder="标签名称">
                                                    <span class="input-group-btn">
                                                    <button type="button" id="addNewTag" class="btn btn-info btn-flat">添加</button>
                                                </span>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>选择标签</label>
                                                <select class="form-control select2" id="tagsList" name="tags[]"
                                                        multiple="multiple" data-placeholder="选择标签"
                                                        style="width: 100%;">
                                                    {{ tagsTree|default('') }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-dashcube"></i> 专题</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>选择专题</label>
                                                <select class="form-control select2" id="subjectList" name="subject"
                                                        data-placeholder="选择专题">
                                                    <?= $subjectTree ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-image"></i> 特色图片</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body" style="">
                                        <div class="form-group col-md-12">
                                            <label for="imageUrl">图片地址</label>
                                            <input type="text" name="cover_image" class="form-control" id="imageUrl"
                                                   placeholder="url" value="{{ info['cover_picture']|default('') }}">
                                        </div>

                                        <div class="form-group col-md-12" id="imagePreview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>