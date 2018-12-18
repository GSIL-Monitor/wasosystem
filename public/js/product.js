/**
 * Created by john on 2016/7/8.
 */
function imgdragstart() {
    return false;
}

/* 禁止拖动图片 部分1 */

$(document).ready(function () {

    for (i in document.images) document.images[i].ondragstart = imgdragstart;
    /* 禁止拖动图片  部分2*/
    if ($('.compare_list li').length > 0) {
        $("#CompareBox").show();
    }
    /*  手机端效果   开始  */


    /*   装机流程图   */
    $(document).on("click", ".liuPic .phone_lookMore", function () {
        if ($(this).hasClass("close")) {
            $(this).text("查看全部").removeClass("close");
            $(this).siblings(".phone_lookMoreBg").show();
            $(this).siblings(".buy_left").css("height", "100px");
        } else {
            $(this).text("隐藏图片").addClass("close");
            $(this).siblings(".phone_lookMoreBg").hide();
            $(this).siblings(".buy_left").css("height", "auto");
        }
    });

    //筛选条件
    var ConditionHeight = $(window).height() - 110;
    var Wheight = $(".body").height() - 40;
    $(document).on("click", '.P_pro_condition .P_condition', function () {
        $("#con_sit").val("1");
        $(".ProRight").css({"height": ConditionHeight, "overflow-y": "scroll"}).hide();
        $('.P_con_box').show();
        $(".ProType").show();
        $('.P_pro_condition').hide();
    });
    $(document).on("click", '.P_con_box .P_cancel', function () {
        $("#con_sit").val("0");
        $(".ProRight").css({"height": "auto", "overflow-y": "visible"}).show();
        $('.P_con_box').hide();
        $('.ProType').hide();
        $('.choosed').hide();
        $('.P_pro_condition').show();
    });
    $(document).on("click", '.P_con_box .P_sure', function () {
        $("#con_sit").val("0");
        $(".ProRight").css({"height": "auto", "overflow-y": "visible"}).show();
        $('.P_con_box').hide();
        $('.ProType').hide();
        $('.choosed').hide();
        $('.P_pro_condition').show();
    });


    function checkSit() {
        var con_sit = $("#con_sit").val();
        var Wwidth = $(window).width();
        if (Wwidth > 900) {
            if (con_sit == '0') {
                $('.hide_condition').removeClass("opend");
            } else if (con_sit == '1') {
                $('.hide_condition').addClass("opend");
            }
        }
    }

    $('.P_search input').focus(function () {
        var P_val = $('.P_search input').val();
        if (P_val == "搜索商品") {
            $(this).val("").css("color", "#333");
        }
    });
    $('.P_search input').blur(function () {
        var P_val = $('.P_search input').val();
        if (P_val == "" || P_val == " ") {
            $(this).val("搜索商品").css("color", "#666");
        }
    });
    /*  手机端效果   结束  */


    /*   产品收藏  */
    $(document).on("click", '.colBtn', function () {
        var data_add_url= $(this).find('em').attr('data_add_url');
        var data_del_url= $(this).find('em').attr('data_del_url');

        var self = $(this);
        if ($(this).hasClass("colAdd")) {
            axios.get(data_add_url)
                .then(function () { // 请求成功会执行这个回调
                    self.removeClass("colAdd").addClass('colDel').html("<i></i><em data_add_url='" + data_add_url + "' data_del_url='" + data_del_url + "'>取消收藏</em>");
                }, function (error) { // 请求失败会执行这个回调
                    // 如果返回码是 401 代表没登录
                    if (error.response && error.response.status === 500) {
                        swal('请先登录', '', 'error').then(function () {
                            location.href = '/login'
                        });
                    } else {
                        // 其他情况应该是系统挂了
                        swal('系统错误', '', 'error');
                    }
                });
        } else {
            axios.get(data_del_url)
                .then(function () { // 请求成功会执行这个回调
                    self.removeClass("colDel").addClass('colAdd').html("<i></i><em data_add_url='" + data_add_url + "' data_del_url='" + data_del_url + "'>添加收藏</em>");
                }, function (error) { // 请求失败会执行这个回调
                    // 如果返回码是 401 代表没登录
                    if (error.response && error.response.status === 500) {
                        swal('请先登录', '', 'error').then(function () {
                            location.href = '/login'
                        });
                    } else {
                        // 其他情况应该是系统挂了
                        swal('系统错误', '', 'error');
                    }
                });
        }

    });


    /*   产品对比  */

    /*  默认检查对比产品数量  */
    // function checkComPareNum(){
    //    var len = $("#CompareBox ul li").length;
    //     $('#CompareBox .compareNum').text(len);
    // }
    // checkComPareNum();

    $(document).on("click", ".proEasy .ComBtn", function () {
        var url = $(this).find('em').attr('data_url');
        var self = $(this);
        if ($(this).hasClass("comAdd")) {
            axios.get(url)
                .then(function () { // 请求成功会执行这个回调
                    var proLength = $(".server .type_box .comDel").length;
                    if (proLength >= 4) {
                        swal('最多只能4个产品对比', '', 'warning');
                        return false;
                    } else {
                        $('#CompareBox').show();
                        self.removeClass("comAdd").addClass('comDel').html("<em data_url='" + url + "'>取消对比</em><i></i>");
                        $("#CompareBox .compareNum").text(proLength +1);
                    }
                }, function (error) { // 请求失败会执行这个回调
                    // 如果返回码是 401 代表没登录
                    if (error.response && error.response.status === 500) {
                        swal('请先登录', '', 'error').then(function () {
                            location.href = '/login'
                        });
                    } else {
                        // 其他情况应该是系统挂了
                        swal('系统错误', '', 'error');
                    }
                });
        } else {
            axios.get(url)
                .then(function () { // 请求成功会执行这个回调
                    var proLength = $(".server .type_box .comDel").length - 1;
                    if (proLength < 1) {
                        $('#CompareBox').hide();
                    }
                    self.removeClass("comDel").addClass('comAdd').html("<em data_url='" + url + "'>添加对比</em><i></i>");
                    $("#CompareBox .compareNum").text(proLength);
                }, function (error) { // 请求失败会执行这个回调
                    // 如果返回码是 401 代表没登录
                    if (error.response && error.response.status === 500) {
                        swal('请先登录', '', 'error').then(function () {
                            location.href = '/login'
                        });
                    } else {
                        // 其他情况应该是系统挂了
                        swal('系统错误', '', 'error');
                    }
                });
        }

    });


    /*  对比栏  全部删除  */
    $(document).on("click", "#CompareBox .clearAll", function () {
        var url = $(this).attr('data_url');
        axios.get(url)
            .then(function () { // 请求成功会执行这个回调
                $("#CompareBox").hide();
            }, function (error) { // 请求失败会执行这个回调
                if (error.response && error.response.status === 500) {
                    swal('请先登录', '', 'error').then(function () {
                        location.href = '/login'
                    });
                } else {
                    // 其他情况应该是系统挂了
                    swal('系统错误', '', 'error');
                }
            });

    });



    /*   产品图片  */
    var WindW = $(document).width();
    if (WindW <= 900) {
        $(".main_pic li img").css({"height": "auto", "width": "100%"});
        $(".buy_left .main_pic ul").css({'height': WindW});
        $(".buy_left .main_pic ul li").css({'height': WindW, 'top': 0});
    }


    /* 点击小图  大图切换 */
    $(document).on("click", ".scroll_pic li", function () {
        $(this).addClass("active").siblings().removeClass("active");
        var LiIndex = $(this).attr("data-number");
        $(".main_pic ul li[data-number='" + LiIndex + "']").addClass("active").siblings("li").removeClass("active");
    });


    /*  软著图片  */

    $(document).on("click", ".copyBtn", function () {
        if (WindW >= 900) {
            var picW = $("#softCopyRight").width() / 2;
            $('#head_black').fadeIn(300);
            $('#softCopyRight').css("margin-left", -picW).fadeIn(300).addClass("softCopyRightOpend");
        } else {
            $('#head_black').fadeIn(300);
            $('#softCopyRight').fadeIn(300).removeClass("softCopyRightOpend");
        }
    });
    $(document).on("click", "#softCopyRight .softCopyClose", function () {
        $('#head_black').fadeOut(300);
        $('#softCopyRight').fadeOut(300);
    });
    $(document).on("click", ".softCopyRightOpend", function () {
        $('#head_black').fadeOut(300);
        $('#softCopyRight').fadeOut(300);
    });


    /*  弹出框默认设置 */
    function OutPicSize() {
        var WindH = $(window).height();
        var WindW = $(document).width();
        if (WindW <= 900) {
            $('.main_pic .arrow').hide();
            $('.main_pic .close').css({"font-size": "40px", "right": "0", "top": "0"});
            WindH -= 100;
        } else {
            if (WindH >= 800) {
                WindH = 800;
            } else if (WindH <= 400) {
                WindH = 400;
            } else {
                WindH -= 100;
            }
        }
        $(".buy_leftMax .main_pic").css({"height": WindH});
    }

    $(document).on("click", ".main_pic img", function () {
        var num = $(this).parents("li").attr("data-number");
        $(".picsBox li[data-number='" + num + "']").trigger("click");
        $('.main_pic .bigP img').each(function () {
            $(this).attr("src", $(this).attr("data-src"));
        });
        if (WindW > 900) {
            $(this).parents(".buy_left").removeClass().addClass("buy_leftMax");
            $('.buy_right').hide();
            $('.info_down').hide();
            $('#foot').hide();
            $(".buy_box").css("z-index", "9999");
            OutPicSize();
        }
    });

    /*  关闭  弹出框默认设置 */
    $(document).on("click", '.main_pic .close', function () {
        $(this).parents(".buy_leftMax").removeClass().addClass("buy_left");
        $(".main_pic").css({"height": '100%'});
        $('.buy_right').show();
        $('.info_down').show();
        $('#foot').show();
        $(".buy_box").css("z-index", "1");
        $('.main_pic .bigP img').each(function () {
            $(this).attr("src", $(this).attr("data-original"));
        });
    });


    /*   左右滑动  */
    $(document).on("swipe", '.main_pic', function (e) {
        e.stopImmediatePropagation();
    });
    var PicLength = $('.scroll_pic li').length - 1;
    $(".main_pic").on("swipeleft", function (e) {
        var LiIndex = $(".scroll_pic .active").index();
        if (LiIndex >= PicLength) {
            $(".scroll_pic li").eq(0).trigger("click");
        } else {
            $(".scroll_pic .active").next("li").trigger("click");
        }
    });
    $(".main_pic").on("swiperight", function (e) {
        var LiIndex = $(".scroll_pic .active").index();
        if (LiIndex <= 0) {
            $(".scroll_pic li").eq(PicLength).trigger("click");
        } else {
            $(".scroll_pic .active").prev("li").trigger("click");
        }
    });

    $(".main_pic .rightArrow").on("click", function () {
        $(".main_pic").trigger("swipeleft");
    });
    $(".main_pic .leftArrow").on("click", function () {
        $(".main_pic").trigger("swiperight");
    });


    /*  加入购物车  未登录  */
    $(document).on("click", ".shop_car_btn", function () {
        location.href = '../Login/login.html';
    });


    /* 弹出编辑征集框 */
    function editMachine(){
        var scrollBox = Math.ceil($(".pro_detail .zyw_material_editor ul").height())  + 50;
        var editInfoHeight = $(".pro_detail .editInfo").height();
        var alertBoxHeight = scrollBox + editInfoHeight;
        var MaxHeight = Math.ceil($(window).height() * 0.8);
        console.log("maxheight : " + MaxHeight);
        console.log("nowHeight : " + alertBoxHeight);
        $(".pro_detail").css({"height": MaxHeight , "top":"10%" , "margin-top" : 0});
        $(".editBox .listTable").css({"height": MaxHeight + "px" });
        MaxHeight -= 217
        $(".pro_detail .listTable .detail_inner").css({"height": MaxHeight + "px" });
        $(".pro_detail .editBoxWrap .zyw_material_editor").css({"padding-top": editInfoHeight});
    }


    /* 编辑框点击修改弹出定位  */
    function alertEdit(div){
        var Y = div.position().top;
        var X = div.offset().left;
        $(".detail_inner .ivu-select-dropdown").css({"bottom": Y +"px" , "left" : X + "px"});
        console.log("X: " + X + " - y: " + Y );
    }
    $(".editDetail").on("click",function(){
        if($(this).hasClass('noLogin')){
          swal('登陆后修改配置！','','warning').then(function () {
              location.href='/login';
          });
        }else{
            editMachine();
            $(".pro_detail").addClass("showProDetail");
            $("#Pic_black").css("z-index",1001).fadeIn(300);
        }

    });
    $(window).resize(function(){
        editMachine();
    });
    $(document).on("click",".edit_Cancel",function(){
        $(".pro_detail").removeClass("showProDetail");
        $("#Pic_black").css("z-index",0).fadeOut(300);
    });

    /*   自选查看  */
    $(".lookDetail").on("click", function () {
        var Width = $(window).width();
        if (Width < 900) {
            $(".Mydetail").css({"max-height": "100%", "height": "100%"});
            $(".Mydetail").stop().animate({top: 0}, 300);
        } else {
            $(".Mydetail").stop().animate({top: "10%"}, 300);
        }
        $("#Pic_black").css("z-index", 9991).fadeIn(300);
    });

    //
    // $(".DoneControl span").on("click", function () {
    //     $("#Pic_black").fadeOut(300);
    //     $(".pro_detail").stop().animate({top: "-900px"}, 300, function () {
    //         $(this).css({"max-height": "70%", "height": "auto"});
    //     });
    //     $(".Mydetail").stop().animate({top: "-900px"}, 300, function () {
    //         $(this).css({"max_height": "70%", "height": "auto"});
    //     });
    // });


    /*配件加入购物车*/
    $("button[name='sub']").on('click', this, function () {
        var add_rule_form = $(".buy_num form").serialize();
        $.post(shopurl, add_rule_form, function (msg) {
            if (msg.sta == 'ok') {
                layer.msg(msg.info, {icon: 1});
                location.reload();
            } else {
                alert(msg.info);
            }
        });
    });

    /*产品立即购买*/
    $(".buy").click(function () {
        var zjid = $(this).data('id');
        var type = $(this).attr('type');
        $.post(buyurl, {zjid: zjid, "type": type}, function (msg) {
            if (msg.sta == 'ok') {
                layer.msg(msg.info, {icon: 1});
                location.href = "../Person/order_wantConfirm.html?ordid=" + msg.id;
            } else {
                layer.msg(msg.info, {icon: 2});
            }
        });
    });

    /*延迟跳转*/
    function tiaozhuan(url) {
        window.location.href = url;
    }


});











