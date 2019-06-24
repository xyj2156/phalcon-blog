<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':topTitle,'_2title':topSubtitle}) }}


<!-- 主内容 -->
<section class="content">
    <div class="row">
        {{ partial('taxonomy/taxonomy_'~type) }}
    </div>
</section>