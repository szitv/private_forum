{% include 'template/head.volt' %}
<body>
<div id="bodypat">
<section id="container">
{% include 'template/header.volt' %}

<section id="portfoliolist-left" class="clearfix">

<div id="filter" class="clearfix">
<ul id="port-filter">
	<li><a href="#">未回复</a></li>
    <li><a href="#">已回复</a></li>
    <li><a href="#">无需回复</a></li>
</ul>
</div>
    {% for article in article_list %}
	<div class="portfoliolist {{ article.type == 0 ? '无需回复' : (article.type_status == 0 ? '未回复' : '已回复') }}">
        <a href="/article/info/{{ article.article_id }}" title="{{ article.uid == 0 ? '匿名用户' : '实名用户' }}，点赞数：{{ article.like_times }}">
        <div class="pl-projecttitle"><span class="pl-title">{{ article.uid == 0 ? '匿名用户' : '实名用户' }}，点赞数：{{ article.like_times }}</span></div>
        <img class="portfoliolist-img" src="/images/placeholder/{{ module_id }}.png" alt="{{ article.uid == 0 ? '匿名用户' : '实名用户' }}，点赞数：{{ article.like_times }}" />
        </a>
    </div>
    {% endfor %}
</section>

<section id="sidebar">

{% include 'template/side.volt' %}

</section>
</section>

{% include 'template/foot.volt' %}
