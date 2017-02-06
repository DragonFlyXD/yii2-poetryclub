/**
 * file refresh_captcha.js 刷新验证码js
 */

$(function () {
    //解决验证码不刷新的问题
    changeVerifyCode();
    $('#captcha-img').on('click', function () {
        $('input').val('');
    });
});
//更改或者重新加载验证码
function changeVerifyCode() {
    $.ajax({
        //使用ajax请求site/captcha方法，加上refresh参数，接口返回json数据
        url: "/site/captcha.html?refresh=1",
        dataType: 'json',
        cache: false,
        success: function (data) {
            //将验证码图片中的图片地址更换
            $("#captcha-img").attr('src', data['url']);
        }
    });
}
