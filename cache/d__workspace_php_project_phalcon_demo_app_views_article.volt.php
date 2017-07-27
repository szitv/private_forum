<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <title>易为码内部论坛</title>
    <link href="/css/my.css" title="style" rel="stylesheet" type="text/css" />
    <link href="/style.css" title="style" rel="stylesheet" type="text/css" />
    <link id="clink" href="/css/style-blue.css" title="style" rel="stylesheet" type="text/css" media="screen"/>
    <script src="/scripts/jquery.min.js" type="text/javascript"></script>
    <script src="/scripts/jquery.masonry.min.js" type="text/javascript"></script>
    <script src="/scripts/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/scripts/MetroJs.lt.js" type="text/javascript"></script>
    <script src="/scripts/jquery.flexslider-min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/scripts/hoverintent.js" type="text/javascript" charset="utf-8"></script>
    <script src="/scripts/jquery.jplayer.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/scripts/organictabs.jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/showdown/showdown.min.js" type="text/javascript" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <style type="text/css">
        @import url("/style-ie8.css");
    </style>
    <script src="/scripts/css3-mediaqueries.js" type="text/javascript" charset="utf-8"></script>
    <script>
        document.createElement('header');
        document.createElement('nav');
        document.createElement('section');
        document.createElement('article');
        document.createElement('aside');
        document.createElement('footer');
        document.createElement('hgroup');
    </script>
    <![endif]-->
    <script src="/scripts/javascript.js" type="text/javascript"></script>
    <script src="/scripts/mediaplayer.js" type="text/javascript"></script>
    <script src="/js/my.js" type="text/javascript"></script>
    <script src="/js/showdown.js" type="text/javascript"></script>
    <?php if (($page == 'write-article')) { ?>
    <script src="/js/upload.image.js" type="text/javascript"></script>
    <?php } ?>
</head>
<body>
<div id="bodypat">
<section id="container">
<header class="clearfix">
	<a id="headerlink" href="/index" title="首页"><img id="logo" src="/images/logo.png" alt="logo" /><span id="sitename">易为码内部论坛</span></a>
</header>
<section id="content" class="clearfix">
<!--<div id="content-title">缘，妙不可言</div>-->
<script>
    $(document).ready(function() {
        var html = '';
        var converter = new showdown.Converter(),
            text = '<?= $article_info->article_real ?>';
            html = converter.makeHtml(text);
        $('#article-real').html(html);
    });
</script>

<section id="single">
    <article id="article-real" style="padding: 20px;" class="sbp-article"></article>
    <div id="authorinfo"><img style="width:80px;height:80px;" id="author-avatar" src="<?= ($user_info != false ? $user_info->portrait : '/images/commenter.png') ?>" alt="Avatar"/>
        <span class="author">来自星星的：<?= ($have_author != 0 ? (($user_info != false ? $user_info->nickName : $nick_name)) : $nick_name) ?></span>
        <p><?= ($have_author != 0 ? (($user_info != false ? '此用户为实名用户' : '此用户为实名用户，但由于网络不给力，用户名随机匹配，如有雷同，纯属偶然。')) : '此用户为匿名用户，用户名随机匹配，如有雷同，纯属偶然。') ?></p>
    </div>

<!-- BEGIN COMMENTS -->
<section id="comments">
<div class="section-title">前方高能</div>

<ol class="commentlist">
    <?php foreach ($comment_list as $comment) { ?>
	<li class="comment">
        <article id="comment-<?= $comment->comment_id ?>">
            <div class="comment-author"><img style="width:80px;height:80px;" class="avatar" src="<?= $comment->portrait ?>" alt="Avatar"/>
                <span class="commenter"><?= $comment->nick_name ?></span><a href="javascript:void(0)" onclick="show_comment_div(<?= $comment->comment_id ?>)" class="comment-reply"><span class="button-met dark">回复</span></a>
                <span class="comment-date"><?= $comment->create_at ?></span>
            </div>
            <div class="comment-content">
                <p><?= $comment->content ?></p>
            </div>
        </article>
        <?php if ($comment->children_list != null) { ?>
        <ul class="children">
            <?php foreach ($comment->children_list as $children) { ?>
            <li class="comment">
            <article id="comment-<?= $comment->comment_id ?>">
                <div class="comment-author"><img style="width:80px;height:80px;" class="avatar" src="<?= $children->portrait ?>" alt="Avatar"/>
                    <span class="commenter"><?= $children->nick_name ?></span>
                    <span class="comment-date"><?= $children->create_at ?></span>
                </div>
                <div class="comment-content">
                    <p><?= $children->content ?></p>
                </div>
            </article>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </li>
    <?php } ?>
</ol>

<div id="respond">
<h1>发表一下意见</h1>
<input type="hidden" id="comment_id" name="comment_id" />
<input type="hidden" id="article_id" value="<?= $article_id ?>" />
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

<div id="recent-box" class="widget">
<h5>来一波骚操作</h5>
<ul class="articles-widget">
<li>
    <a id="<?= $login_id ?>" href="javascript:void(0)">
        <img src="/images/placeholder/medium_blank.png" alt="<?= $login_title ?>" />
        <div class="title"><span id="login_status"><?= $login_title ?></span><br><span id="login_name" class="limetxt"><?= $login_message ?></span></div>
        <div class="more"></div>
    </a>
</li>
<li>
    <a href="http://www.appinn.com/markdown/" target="_blank">
    <img src="/images/placeholder/medium_blank.png" alt="Markdown基础用法" />
    <div class="title">Markdown基础用法<br><span class="limetxt">写东西要用到markdown语法</span></div>
    <div class="more"></div>
    </a>
</li>
<li>
    <a href="/article/write/0">
    <img src="/images/placeholder/medium_blank.png" alt="写作文" />
    <div class="title">写作文<br><span class="limetxt">我要写出一篇散文集！</span></div>
    <div class="more"></div>
    </a>
</li>
<li>
    <a href="http://admin.emto.cn/pages/index.html"  target="_blank">
    <img src="/images/placeholder/medium_blank.png" alt="易蚂蚁" />
    <div class="title">易蚂蚁<br><span class="limetxt">吐槽完乖乖工作去</span></div>
    <div class="more"></div>
    </a>
</li>
</ul>
</div>


<div class="widget text-widget">
<h5>说明</h5>
<p>本论坛属于内部论坛，仅限内部局域网访问，除投票专区外，其他模块均能够匿名发布，管理员有权对影响力过大的模块或发言进行屏蔽处理，请大家理智发言。</p>
</div>



</section>
</section>

<footer class="clearfix" style="color:#fff"><span>深圳市易为码技术有限公司出品</span></footer>
</section><!-- end #container -->
</div>
</body>
</html>

