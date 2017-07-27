{% include "template/head.volt" %}
<body>
<div id="bodypat">
<section id="container">
{% include "template/header.volt" %}
<script>
    $(document).ready(function() {
        var html = '';
        var converter = new showdown.Converter(),
            text = '{{ article_info.article_real }}';
            html = converter.makeHtml(text);
        $('#article-real').html(html);
    });
</script>

<section id="single">
    <article id="article-real" style="padding: 20px;" class="sbp-article"></article>
    <div id="authorinfo"><img style="width:80px;height:80px;" id="author-avatar" src="{{ user_info != false ? user_info.portrait : '/images/commenter.png' }}" alt="Avatar"/>
        <span class="author">来自星星的：{{ have_author != 0 ? (user_info != false ? user_info.nickName : nick_name) : nick_name }}</span>
        <p>{{ have_author != 0 ? (user_info != false ? '此用户为实名用户' : '此用户为实名用户，但由于网络不给力，用户名随机匹配，如有雷同，纯属偶然。') : '此用户为匿名用户，用户名随机匹配，如有雷同，纯属偶然。' }}</p>
    </div>

<!-- BEGIN COMMENTS -->
<section id="comments">
<div class="section-title">前方高能</div>

<ol class="commentlist">
    {% for comment in comment_list %}
	<li class="comment">
        <article id="comment-{{ comment.comment_id }}">
            <div class="comment-author"><img style="width:80px;height:80px;" class="avatar" src="{{ comment.portrait }}" alt="Avatar"/>
                <span class="commenter">{{ comment.nick_name }}</span><a href="javascript:void(0)" onclick="show_comment_div({{ comment.comment_id }})" class="comment-reply"><span class="button-met dark">回复</span></a>
                <span class="comment-date">{{ comment.create_at }}</span>
            </div>
            <div class="comment-content">
                <p>{{ comment.content }}</p>
            </div>
        </article>
        {% if comment.children_list != null %}
        <ul class="children">
            {% for children in comment.children_list %}
            <li class="comment">
            <article id="comment-{{ comment.comment_id }}">
                <div class="comment-author"><img style="width:80px;height:80px;" class="avatar" src="{{ children.portrait }}" alt="Avatar"/>
                    <span class="commenter">{{ children.nick_name }}</span>
                    <span class="comment-date">{{ children.create_at }}</span>
                </div>
                <div class="comment-content">
                    <p>{{ children.content }}</p>
                </div>
            </article>
            </li>
            {% endfor %}
        </ul>
        {% endif %}
    </li>
    {% endfor %}
</ol>

<div id="respond">
<h1>发表一下意见</h1>
<input type="hidden" id="comment_id" name="comment_id" />
<input type="hidden" id="article_id" value="{{ article_id }}" />
<div id="commentformright">
<p class="comment-form-comment">
<textarea id="comment" placeholder="为保证界面好看，当前仅支持二级评论，现在可以畅所欲言啦。" name="comment"></textarea>
</p>
<span class="button-met dark">
    <button id="comment-submit" style="background: none;font: inherit;color: inherit;cursor: pointer;">写完了</button>
</span>
</div>
</div>

</section>
</section>


<!-- BEGIN SIDEBAR -->
<section id="sidebar">

<div id="post-meta" class="widget">
<div class="tile-sidebar" style="background:#3b5998; cursor:pointer;" onclick="like();">
    <label style="position:absolute;margin-top: 13%;margin-left: 40%;">点一波赞</label>
</div>
</div>

{% include "template/side.volt" %}

</section>
</section>

{% include "template/foot.volt" %}

