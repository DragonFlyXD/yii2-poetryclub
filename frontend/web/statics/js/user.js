/**
 * file user.js 用户中心js
 */

$(function () {

    //标签页加载其他页面
    $('.u-menu a').click(function (e) {
        loadTabs(e);
    });

    //更改用户头像浮现效果
    $('.avatar-mode').mouseenter(function () {
        $('.upload-avatar').css('bottom', '0');
    }).mouseleave(function () {
        $('.upload-avatar').css('bottom', '-45px');
    });

    //收藏时分页
    $('.coll-page').click(function () {
        alert(1);
        var url = $(this).find('a').attr('href');
        $.ajax({
            url: url + "&r=" + Math.random(),
            type: 'get',
            success: function (data) {
                $('.u-center-r').html(data);
            },
            error: function (xhr, txtStatus, errorThrown) {
                alert('邪灵入侵,页面发生错误: ' + errorThrown);
            },
        })
    });

});

//加载标签页
function loadTabs(e) {
    var url = $(e.target).attr('data-url');
    var href = $(e.target).attr('href');
    e.preventDefault();
    $(e.target).tab('show');
    $.ajax({
        url: url + "&r=" + Math.random(),
        type: 'get',
        success: function (data) {
            if (href == "#u-index") { //如果加载了个人动态,则重新刷新
                location.reload();
            } else {
                $('.u-center-r').html(data);
                if (href == "#setprofile") {    //加载个人信息界面
                    submitUesrInfo();   //添加修改个人信息事件
                    //修改个人信息的模态框效果
                    $('.u-edit').on('click', function () {
                        $('#u-modal').modal();
                    });
                    //调用日期选择控件
                    $.uDatePicker({});
                } else if (href == "#collect-record") {
                    deleteCollect(url);    //添加删除收藏的诗文的事件
                }
            }
        },
        error: function (xhr, txtStatus, errorThrown) {
            alert('邪灵入侵,页面发生错误: ' + errorThrown);
        },
    })
}


//修改个人信息
function submitUesrInfo() {
    $('#u-sumbit').click(function () {
        var userinfo = $('#u-form').serializeArray(); //序列化表格元素
        var birthday = $('.sel-y').val() + '-' + $('.sel-m').val() + '-' + $('.sel-d').val();
        userinfo.push({'name': 'birthday', 'value': birthday});   //处理并添加生日值
        var url = $(this).attr('data-url');

        $.ajax({
            url: url + "?r=" + Math.random(),
            type: 'post',
            dataType: 'json',
            data: userinfo,
            success: function (data) {
                if (data.status) { //如果修改成功,则重新加载该页面
                    location.reload();
                } else {
                    alert(data.message); //如果修改失败,则弹错误信息
                }
            },
            error: function (xhr, txtStatus, errorThrown) {
                alert('邪灵入侵,页面发生错误: ' + errorThrown);
            }
        });
    });
}

//删除诗文收藏
function deleteCollect(desturl) {
    $('.delete-coll').click(function (e) {
        var url = $(this).attr('data-url');
        $('.coll-modal').modal('show');
        $('.coll-modal-submit').click(function () {
            $.ajax({
                url: url + "&r=" + Math.random(),
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        //隐藏模态框
                        $('.coll-modal').on('hidden.bs.modal', function () {   //模态框隐藏后,加载收藏页面
                            $('#collect-record').trigger('click');
                        }).modal('hide');
                    } else {
                        alert(data.message);
                    }
                },
                error: function (xhr, txtStatus, errorThrown) {
                    alert('邪灵入侵,页面发生错误: ' + errorThrown);
                },
            });
        });
    });
}

//加载指定页面
function loadPage(url, options) {
    var defaultSetting = {
        type: 'get',
        dataType: 'html',
    };
    $.extend(defaultSetting, options);
    $.ajax({
        url: url + "&r=" + Math.random(),
        type: defaultSetting.type,
        dataType: defaultSetting.dataType,
        success: function (data) {
            $('.u-center-r').html(data);
        },
        error: function () {
            alert('邪灵入侵,页面发生错误: ' + errorThrown);
        }
    });
}

//日期选择控件插件
(function ($) {
    $.extend({
        uDatePicker: function (options) {

            //插件默认参数
            var defaults = {
                YearSelector: ".sel-y",
                MonthSelector: ".sel-m",
                DaySelector: ".sel-d",
                FirstText: "--",
                FirstValue: 0
            };

            //合并属性
            var opts = $.extend({}, defaults, options);

            //赋值新属性
            var $YearSelector = $(opts.YearSelector),
                $MonthSelector = $(opts.MonthSelector),
                $DaySelector = $(opts.DaySelector),
                FirstText = opts.FirstText,
                FirstValue = opts.FirstValue;


            //初始化
            var str = '<option value="' + FirstValue + '">' + FirstText + '</option>';
            $YearSelector.html(str);
            $MonthSelector.html(str);
            $DaySelector.html(str);

            //年月日初始化
            var yInit = $YearSelector.attr('data-init', 1996),
                mInit = $MonthSelector.attr('data-init', 7),
                dInit = $DaySelector.attr('data-init', 21);

            //年份列表
            var yearNow = new Date().getFullYear(),
                yearSel = $YearSelector.attr("data-init");
            for (var i = yearNow; i >= 1900; i--) {
                var init = yearSel == i ? "selected" : "";
                var yearStr = '<option value="' + i + '" ' + init + '>' + i + '</option>';
                $YearSelector.append(yearStr);
            }

            //月份列表
            var monthSel = $MonthSelector.attr('data-init');
            for (var i = 1; i <= 12; i++) {
                var init = monthSel == i ? "selected" : "";
                var monthStr = '<option value="' + i + '" ' + init + '>' + i + '</option>';
                $MonthSelector.append(monthStr);
            }

            //日列表
            function buildDay() {
                if ($YearSelector.val() == 0 || $MonthSelector.val() == 0) {
                    //未选择年份或月份
                    $DaySelector.html(str);
                } else {
                    $DaySelector.html(str);
                    var year = parseInt($YearSelector.val()),
                        month = parseInt($MonthSelector.val()),
                        dayCount = 0;
                    switch (month) {
                        case 1:
                        case 3:
                        case 5:
                        case 7:
                        case 8:
                        case 10:
                        case 12:
                            dayCount = 31;
                            break;
                        case 4:
                        case 6:
                        case 9:
                        case 11:
                            dayCount = 30;
                        case 2:
                            dayCount = 28;
                            if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) {
                                dayCount = 29;
                            }
                            break;
                        default:
                            break;
                    }

                    var daySel = $DaySelector.attr("data-init");
                    for (var i = 1; i <= dayCount; i++) {
                        var init = daySel == i ? "selected" : "";
                        var dayStr = '<option value="' + i + '" ' + init + '>' + i + '</option>';
                        $DaySelector.append(dayStr);
                    }
                }
            }

            $YearSelector.change(function () {
                buildDay();
            });

            $MonthSelector.change(function () {
                buildDay();
            });

            if ($DaySelector.attr("data-init") != "") {
                buildDay();
            }
        },
    });
})(jQuery);

