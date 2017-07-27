{% include "template/head.volt" %}
<body>
<div id="bodypat">
<section id="container">
{% include "template/header.volt" %}

<section id="bloglist-left" class="clearfix">
    {% for module in module_list %}
    <div class="bloglist">
        {% if (module.id == 4) %}
        <a href="javascript:void(0)" onclick="layer.msg('敬请期待');return false;" title="{{ module.description }}">
        {% else %}
        <a href="/article/index/{{ module.id }}" title="{{ module.description }}">
        {% endif %}
        <div class="bl-posttitle"><span class="bl-title">{{ module.description }}</span></div>
        <img class="bloglist-img" src="/images/placeholder/{{ module.id }}.png" alt="{{ module.name }}" />

        </a>
    </div>
    {% endfor %}

</section>

<section id="sidebar">
    {% include "template/side.volt" %}
</section>

</section>
{% include "template/foot.volt" %}

