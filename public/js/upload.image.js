$(function() {
    var oDiv = $("#drop-box").get(0);
    var oP = $(".text");
    oDiv.ondragenter = function() {

    };
    //移动，需要阻止默认行为，否则直接在本页面中显示文件
    oDiv.ondragover = function(e) {
        e.preventDefault();
    };
    //离开
    oDiv.onleave = function() {

    };
    //拖拽放置，也需要阻止默认行为
    oDiv.ondrop = function(e) {
        e.preventDefault();
        var fs = e.dataTransfer.files;
        console.log(fs.length);
        //循环多文件拖拽上传
        for (var i = 0; i < fs.length; i++) {
            //文件类型
            var _type = fs[i].type;

            //判断文件类型
            if (_type.indexOf('image') != -1) {
                //文件大小控制
                console.log(fs[i].size);
                //读取文件对象
                var reader = new FileReader();
                //读为DataUrl,无返回值
                reader.readAsDataURL(fs[i]);
                reader.onloadstart = function(e) {
                    //开始加载
                };
                // 这个事件在读取进行中定时触发
                reader.onprogress = function(e) {

                };

                //当读取成功时触发，this.result为读取的文件数据
                reader.onload = function() {
                    //var now_value = $('#comment').val();
                    //$('#comment').val(now_value + '<img style="width:100px;" src="' + this.result + '" />');
                    console.log(this.result);
                    $.ajax({
                        type: "POST",
                        url: "/uploadImage",
                        contentType: "application/json",
                        dataType: "json",
                        data: this.result,
                        success: function (jsonResult) {
                            if (jsonResult.code === 1) {
                                var now_value = $('#comment').val();
                                var img = '!['+jsonResult.name+']('+jsonResult.path+')';
                                $('#comment').val(now_value + img + "\n");
                                var converter = new showdown.Converter(),
                                    text = $('.article-init').val();
                                html = converter.makeHtml(text);
                                $('.article-real').html(html);
                            } else {
                                layer.msg(jsonResult.msg);
                            }
                        }
                    });
                };
                //无论成功与否都会触发
                reader.onloadend = function() {
                    if (reader.error) {
                        console.log(reader.error);
                    } else {
                        //上传没有错误，ajax发送文件，上传二进制文件
                    }
                }
            } else {
                alert('请上传图片文件！');
            }
        }

    }
});