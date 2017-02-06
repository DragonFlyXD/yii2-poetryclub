/**
 * chat小部件js
 */

$(function () {
    sumbitFeed();

});

//feed小部件提交按钮事件
function sumbitFeed() {
    $(".feed-submit").click(function () {
        var url = $(this).attr("data-url");   //获取发送请求的url字符串
        var feed = {
            content: $('.feed-content').val(),
            p_id: $(".feed-submit").attr("data-pid"),   //诗文ID
        };

        if ($('.feed-content').val() == "") { //如果文本框内容为空
            $('.field-feed-content').addClass('has-error');
            return false;
        }
        $.ajax({
            url: url + "?r=" + Math.random(),
            type: "post",
            dataType: "json",
            data: feed,
            success: function (data) {
                if (data.status) {  //如果创建成功,则刷新页面
                    location.reload();
                } else { //创建错误,弹出错误信息
                    alert(data.message);
                }
            },
            error: function (xhr, txtStatus, errorThrown) {
                if (errorThrown == "Forbidden") {
                    $('.alert-error').slideToggle('300').one('click', function () {
                        $(this).fadeToggle('500');
                    }).find('button').removeAttr('data-dismiss');
                }
            }
        });
    });
}