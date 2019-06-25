<header class="main-header">
    <!-- Logo -->
    <a href="{{ url.get('admin.html') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            {{ image(
                'backend/img/touch-icon.png',
                'alt':'Jason',
                'height':45,
                'width':45
            ) }}
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            {{ image(
                'backend/img/logo.png',
                'alt':'Jason',
                'height':45
            ) }}
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">
    <section class="sidebar">
        <!-- 侧边菜单 sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {% for menu in config.admin.menu %}
                {% switch menu.type %}
                {% case 2 %}
                    <li class="treeview
                    {% if controllerName in menu.controller.toArray() %}
                        {% if type is defined and menu._type is not empty %}
                            {% if type in menu._type.toArray() %}
                                active
                            {% endif %}
                        {% else %}
                            active
                        {% endif %}
                    {% endif %}">
                        <a href="#">
                            <i class="fa {{ menu.icon }}"></i> <span>{{ menu.name }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            {% for children in menu.target %}
                                <li {% if children.controller == controllerName and children.action == actionName %} {% if children.type is empty or type == children.type %}class="active"{% endif %} {% endif %}>
                                    <a href="{{ url.get(children.target) }}"><i
                                                class="fa {{ children.icon }}"></i> {{ children.name }}
                                    </a>
                                </li>
                            {% endfor %}
                        </ul>
                    </li>
                {% break %}
                {% case 1 %}
                    <li
                            {% if menu.controller == controllerName %}class="active" {% endif %}
                    >
                        <a href="#"><i class="fa {{ menu.icon }}"></i> <span>{{ menu.name }}</span></a>
                    </li>
                {% break %}
                {% default %}
                    <li class="header">{{ menu.name }}</li>
                {% endswitch %}
            {% endfor %}
        </ul>
    </section>
</aside>