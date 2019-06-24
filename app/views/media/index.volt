<!-- 页头 -->
{{ partial('layouts/content_header', ['_1title' : '媒体库']) }}

<!-- 主内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-12 ">
            <ul class="mailbox-attachments clearfix">
                {% for k,v in resources %}
                    <li id="meida_{{ v.resource_id }}">
                        {% if v.resource_type == 'picture' %}
                            <span class="">
                                <img src="{{ v.guid }}" alt="{{ v.resource_title }}" width="200px"
                                     height="200px">
                            </span>

                        {% else %}
                            <span class="mailbox-attachment-icon">
                                <i class="fa fa-file-{{ v.resource_type }}-o"></i>
                            </span>

                        {% endif %}
                        <div class="mailbox-attachment-info"
                             style="overflow: hidden; text-overflow:ellipsis;white-space: nowrap;">
                            <a href="#" class="mailbox-attachment-name">
                                <i class="fa fa-paperclip"></i>
                                <?= $v['resource_title'] ?>
                            </a>
                            <span class="mailbox-attachment-size">
                                <?= $v['upload_date'] ?>
                            </span>
                        </div>
                    </li>
                {% endfor %}
            </ul>
        </div>
    </div>
</section>