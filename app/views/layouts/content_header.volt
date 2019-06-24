{# 页头 #}
<section class="content-header">
    <div class="msgTip col-md-12">
        <div class="row">
            <?php $this->flash->output(); ?>
        </div>
    </div>
    <h1>
        {{ _1title|default('没有标题') }}
        <small>{{ _2title|default('') }}</small>
    </h1>
</section>