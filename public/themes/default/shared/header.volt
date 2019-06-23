<div class="author col-12">
    <div class="row justify-content-center">
        {#        首页头像 #}
        <div class="author-img col-xs-12 col-md-4 col-lg-2">
            {{ image('themes/default/public/images/self.png',
                'class':'img-thumbnail rounded-circle mx-auto d-block img-fluid',
                'alt':'cover',
                'height':'120',
                'width':'120'
            ) }}
        </div>
        <div class="author-word col-xs-12 col-md-4 col-lg-2">
            <h4 class="author-name col-xs-12 text-center text-md-left">
                <strong>{{ blogname|default('Json Blog') }}</strong>
            </h4>
            <p class="author-desc col-xs-12 text-center text-md-left">
                {{ blogdescription|default('phalcon 开发的 博客') }}
            </p>
        </div>
    </div>

</div>

<nav class="navbar navbar-light navbar-expand-md col-12 sticky-top">
    <div class="container">
        <!--<a class="navbar-brand" href="#">Navbar</a>-->
        <div class="collapse navbar-collapse col-md-10" id="navbarNavDropdown">
            {{ partial('shared/nav') }}
        </div>
        <form class="form-inline">
            <div class="navbar-search input-group-sm input-group">
                <input type="text" class="form-control" placeholder="查找..." aria-label="搜索">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>