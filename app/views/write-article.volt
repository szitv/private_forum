{% include "template/head.volt" %}
<body>
<div id="bodypat">
<section id="container">
{% include "template/header.volt" %}

<section id="bloglist-left" class="clearfix">
    <section id="single">
        <article id="article" class="sbp-article">
            <article class="article-real"></article>
            <div id="filter" style="margin-bottom: 0" class="clearfix">
                <ul id="port-filter">
                {% for module in module_list %}
                    {% if module.id == 1 %}
                    <li id="select-write-module" class="filter-current"><a href="javascript:void(0)" onclick="select_write_module({{ module.id }})">{{ module.name }}</a></li>
                    {% else %}
                    <li id="select-write-module"><a href="javascript:void(0)" onclick="select_write_module({{ module.id }})">{{ module.name }}</a></li>
                    {% endif %}
                {% endfor %}
                </ul>
                <input type="hidden" id="write-module" value="1" />
            </div>
            <div id="drop-box">
                <textarea id="comment" class="article-init" placeholder="" name="comment"></textarea>
            </div>
            <div class="button-div">
                    <a href="javascript:void(0);"  id="download-article">
                        <span id="download-html-btn" class="button-met dark"><button id="download-btn">点击生成</button></span>
                    </a>
                    <span id="write-question-btn" class="button-met dark"><button id="commit-question">发表提问</button></span>
                    <span id="write-article-btn" class="button-met dark"><button id="commit-article">发表文章</button></span>
                </div>
        </article>

    </section>
</section>

<section id="sidebar">
    {% include "template/side.volt" %}
</section>

</section>