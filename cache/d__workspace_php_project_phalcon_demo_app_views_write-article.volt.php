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

<section id="bloglist-left" class="clearfix">
    <section id="single">
        <article id="article" class="sbp-article">
            <article class="article-real"></article>
            <div id="filter" style="margin-bottom: 0" class="clearfix">
                <ul id="port-filter">
                <?php foreach ($module_list as $module) { ?>
                    <?php if ($module->id == 1) { ?>
                    <li id="select-write-module" class="filter-current"><a href="javascript:void(0)" onclick="select_write_module(<?= $module->id ?>)"><?= $module->name ?></a></li>
                    <?php } else { ?>
                    <li id="select-write-module"><a href="javascript:void(0)" onclick="select_write_module(<?= $module->id ?>)"><?= $module->name ?></a></li>
                    <?php } ?>
                <?php } ?>
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