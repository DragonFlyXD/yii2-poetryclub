/**
 * file poem.js 诗文js
 */

$(function () {


    //创建诗文
    $('.view-title-create').click(function () {
        var url = $(this).attr("data-url");
        $.ajax({
            url: url + "?r=" + Math.random(),
            success: function () {  //如果请求成功,跳转到创建诗文页面
                location.href = url;
            },
            error: function (xhr, txtStatus, errorThrown) {
                if (errorThrown == "Forbidden") {   //如果是游客,弹出提示框
                    $('.view-title-alert').modal('show');
                }
            },
        })
    });

    //定位到留言文本框
    $('.view-title-write').click(function () {
        window.location.href = $(this).attr('data-url');
        $('#feed-content').focus();
    });

    //赞诗文
    $('.view-title-praise').click(function () {
        var url = $(this).attr('data-url');
        var id = url.substring(url.indexOf('?') + 1);
        $.ajax({
            url: url + "&r=" + Math.random(),
            type: 'get',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    //模态框隐藏后,静态加载页面
                    $('.page-evaluate .view-title-praise').html("<i class='" + data.data['style'] + "'></i><span>" + data.data['praise'] + "</span>")
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, txtStatus, errorThrown) {
                if (errorThrown == "Forbidden") {
                    $('.view-title-alert').modal('show');
                }
            },
        });
    });


    //诗文收藏
    $('.view-title-coll').click(function () {
        var url = $(this).attr('data-url');
        var id = url.substring(url.indexOf('?') + 1);
        $.ajax({
            url: url + "&r=" + Math.random(),
            type: 'get',
            dataType: "json",
            success: function (data) {
                if (data.status) {
                    if (data.data['status']) { //如果是收藏状态
                        $('.modal-body').html('<p>旅行者,英灵<strong class="text-danger">【' + data.data["title"] + '】</strong>,已经被俘获。\\(^o^)/~</p>');
                    } else { //如果是未收藏状态
                        $('.modal-body').html('<p>伙计,英灵<strong class="text-danger">【' + data.data["title"] + '】</strong>,已经被释放。/(ㄒoㄒ)/~~</p>')
                    }
                    //改变收藏状态时,弹出提示框
                    $('.view-title-modal').modal('show')
                        .on('hidden.bs.modal', function () {   //模态框隐藏后,静态加载页面
                            $('.panel-heading .view-title-coll').html("<i class='" + data.data['style'] + "'></i>")
                            $('.page-evaluate .view-title-coll').html("<i class='" + data.data['style'] + "'></i><span>" + data.data['collect'] + "</span>")
                        });
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, txtStatus, errorThrown) {
                if (errorThrown == "Forbidden") {
                    $('.view-title-alert').modal('show');
                }
            },
        });
    });

});
