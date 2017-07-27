    $(document).ready(function() {
        //首页
        $('#showLoginDiv').click(function() {
            var html = '<div class="layer-div">';
            html += '<p><label>用户名：</label><span><input type="text" id="login_user" /></span></p>';
            html += '<p><label>密&nbsp;&nbsp;&nbsp;&nbsp;码：</label><span><input type="password" id="login_pass" /></span></p>';
            html += '<p><button id="login-submit" onclick="return login_submit();">登录</button></p>';
            html += '</div>';
            layer.open({
                type: 1,
                area: ['500px', '300px'],
                title: '使用易蚂蚁账号登录',
                shade: 0.6,
                anim: 1,
                content: html
            });
        });
        $('#logout').click(function() {
            $.ajax({
                type: "POST",
                url: "/logout",
                contentType: "application/json",
                dataType: "json",
                data: null,
                success: function (jsonResult) {
                    if (jsonResult.code === 1) {
                        window.location.reload();
                    } else {
                        layer.msg(jsonResult.msg);
                    }
                }
            });
        });

        //发布文章页
        $('#commit-article').click(function() {
            var article = $('.article-init').val();
            var module = $('#write-module').val();
            var article_real = $('.article-real').html();
            if (article_real != '') {
                $.ajax({
                    type: "POST",
                    url: "/writeArticle",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify({"article_init": article, "article_real": article_real}),
                    beforeSend: function (request) {
                        request.setRequestHeader("module", module);
                        request.setRequestHeader("type", 0);
                    },
                    success: function (jsonResult) {
                        if (jsonResult.code === 1) {
                            window.location.href = '/article/index/' + module;
                        } else {
                            layer.msg(jsonResult.msg);
                        }
                    }
                });
            } else {
                layer.msg('不写点东西么？');
            }
        });
        $('#commit-question').click(function() {
            var article = $('.article-init').val();
            var module = $('#write-module').val();
            var article_real = $('.article-real').html();
            if (article_real != '') {
                $.ajax({
                    type: "POST",
                    url: "/writeArticle",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify({"article_init": article, "article_real": article_real}),
                    beforeSend: function (request) {
                        request.setRequestHeader("module", module);
                        request.setRequestHeader("type", 1);
                    },
                    success: function (jsonResult) {
                        if (jsonResult.code === 1) {
                            window.location.href = '/article/index/' + module;
                        } else {
                            layer.msg(jsonResult.msg);
                        }
                    }
                });
            } else {
                layer.msg('不写点东西么？');
            }
        });

        $('#download-article').click(function() {
            var article_real = $('.article-real').html();
            if (article_real != '') {
                $.ajax({
                    type: "POST",
                    url: "/article/download/0",
                    contentType: "application/json",
                    dataType: "json",
                    data: article_real,
                    success: function (jsonResult) {
                        $('#download-article').attr('target', '_blank');
                        $('#download-article').attr('href', '/download/' + jsonResult.file_name);
                        $('#download-btn').html('一键下载');
                    }
                });

            } else {
                layer.msg('你都没写东西，恕在下无能为力帮你生成东西出来');
            }
        });

        //评论
        $('#comment-submit').click(function() {
            var article_id = $('#article_id').val();
            var comment_id = $('#comment_id').val();
            var comment = $('#comment').val();
            if (comment_id == '') {
                comment_id = 0;
            }
            $.ajax({
                type: "POST",
                url: "/article/comment/"+article_id,
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({"comment_id":comment_id,"comment":comment}),
                success: function (jsonResult) {
                    if (jsonResult.code === 1) {
                        window.location.href = '/article/info/'+article_id;
                    } else {
                        layer.msg(jsonResult.msg);
                    }
                }
            });
        });

    });

    var login_submit = function() {
        var username = $('#login_user').val();
        var password = $('#login_pass').val();
        $.ajax({
            type: "POST",
            url: "/login",
            contentType: "application/json",
            dataType: "json",
            data: '{"userName":"'+username+'","passWord":"'+password+'"}',
            success: function (jsonResult) {
                if (jsonResult.code === 1) {
                    $('#login_status').html('欢迎你');
                    $('#login_name').html(jsonResult.nickname);
                    window.location.reload();
                } else {
                    layer.msg(jsonResult.msg);

                }
            }
        });
    };

    var select_write_module = function($module_id) {
        $('#write-module').val($module_id);
    };

    var show_comment_div = function(comment_id) {
        if (comment_id == '') {
            comment_id = 0;
        }
        $('#comment_id').val(comment_id);

        var html = '<div class="layer-div">';
        html += '<p><label>请输入你要评论的内容：</label></p>';
        html += '<p><textarea id="comment_comment"></textarea></p>';
        html += '<p><button id="login-submit" onclick="return comment_submit();">确认评论</button></p>';
        html += '</div>';
        layer.open({
            type: 1,
            area: ['500px', '300px'],
            title: '回复评论',
            shade: 0.6,
            anim: 1,
            content: html
        });
    };


    var comment_submit = function() {
        var article_id = $('#article_id').val();
        var comment_id = $('#comment_id').val();
        var comment = $('#comment_comment').val();
        if (comment_id == '') {
            comment_id = 0;
        }
        $.ajax({
            type: "POST",
            url: "/article/comment/"+article_id,
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({"comment_id":comment_id,"comment":comment}),
            success: function (jsonResult) {
                if (jsonResult.code === 1) {
                    window.location.href = '/article/info/'+article_id;
                } else {
                    layer.msg(jsonResult.msg);
                }
            }
        });
    };

    var like = function() {
        var article_id = $('#article_id').val();
        var like = window.localStorage.getItem('like_'+article_id);
        if (like == 1) {
            layer.msg('你已经对这篇文章点过赞了');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "/article/like/"+article_id,
                contentType: "application/json",
                dataType: "json",
                data: null,
                success: function (jsonResult) {
                    layer.msg(jsonResult.msg);
                }
            });
            window.localStorage.setItem('like_'+article_id, '1');
        }
    };
