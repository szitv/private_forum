$(document).ready(function() {
    $('.article-init').keyup(function() {
        var html = '';
        var converter = new showdown.Converter(),
            text = $('.article-init').val();
            html = converter.makeHtml(text);
        $('.article-real').html(html);
    });

});