<ul class="navbar-nav">
    {% for nav in config.home.nav %}
        <li class="nav-item {% if router.getRewriteUri() == url.get(nav.router.toArray()) %} active {% endif %}">
            <a class="nav-link" href="{{ url.get(nav.router.toArray()) }}">
                <i class="fa {{ nav.icon }}"></i>
                {{ nav.name }}
                <span class="sr-only">(current)</span>
            </a>
        </li>
    {% endfor %}
</ul>