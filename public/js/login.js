/**
 * Created by john on 2016/11/1.
 */
function vee_errors(vee,key,err_msg) {
    const field = vee.$validator.fields.find({name: key, scope: vee.$options.scope});
    if (!field) return;
    vee.$validator.errors.add({
        id: field.id,
        field: key,
        msg: err_msg,
        scope: vee.$options.scope,
    });
}
/*  更新验证码 */
function UpCode() {
    $(".code_pic img").trigger("click");
}

var vm=new Vue({
    el:"#app",
    data:{
        username:"",
        password:'',
        captcha:'',
        remember:''
    },
    created:function(){
        let that = this;
        document.onkeypress = function(e) {
            var keycode = document.all ? event.keyCode : e.which;
            if (keycode == 13) {
                that.login();// 登录方法名
                return false;
            }
        };
    },
    methods:{
        login:function(){
            var self=this;
            var Notice=this.$Notice;
            this.$validator.validateAll().then(function (msg) {
                if(msg){
                    var url=$("#login").attr('action');
                    var data=$("#login").fixedSerialize();
                    axios.post(url,data).then(function (response) {
                        Notice.success(
                            {
                                title: "登陆成功！",
                                duration: 1,
                                onClose: function () {
                                    location.href = location_url;
                                }
                            });

                    }).catch(function (err) {
                        if(err.response.data.errors !=undefined){
                            $.each(err.response.data.errors,function (name,errMsg) {
                                console.log(name,errMsg)
                                if(name != 'captcha' && name != 'password'){
                                    name='username'
                                }
                                vee_errors(self,name,errMsg[0])
                                UpCode();
                            });
                        }

                    });
                }
            });
        }
    }
});
/*  判断验证码 */
$(document).ready(function () {



    /* 默认高度  */
    var windW = $(window).width();
    if (windW < 900) {
        $('.logoBox img').attr("src", "pic/logo.png");
    }


    function windSize() {
        var bodyH = $(window).height();
        var loginBoxH = $(".loginBox").height() + 80;
        var loginBoxTop = parseInt((bodyH * 0.8 - loginBoxH) / 2);
        $("#login_body").css("height", bodyH * 0.8);
        $(".loginBox").css("top", loginBoxTop);
    }

    $(window).resize(function () {
        windSize();
    });
    windSize();



    /* 点击微信登陆 */
    $(document).on("click", ".goToWei",function(){
        $(this).removeClass("goToWei").addClass("goToPwd")
        $(".btnTips").html("点击这里账户登录<i></i>")
        $(".loginBox .weiLogin").show();
        $(".loginBox .pwdLogin").hide();
    });

    /* 点击账号登陆 */
    $(document).on("click", ".goToPwd",function(){
        $(this).removeClass("goToPwd").addClass("goToWei")
        $(".btnTips").html("点击这里微信登录<i></i>")
        $(".loginBox .weiLogin").hide();
        $(".loginBox .pwdLogin").show();
    })

    /*  提示隐藏 */
    function HideTip() {
        $(".check_info_box .error_msg").hide();
    }

    /*  提示边框隐藏 */
    function HideBorder() {
        $(".tab_box li").css("border-color", "#dedede");
    }


    /*  取消红线 */
    $('.tab_box li input').on("focus", function () {
        $(this).parents("li").css("border-color", "#dedede");
        $(".check_info_box .error_msg").hide();
    });


    /*  提交信息 */

    $(document).on('click', '#sub', function () {
        var form = $('.loginBox form').fixedSerialize();
        HideTip();
        HideBorder();
        axios.post(url, form + '&_method=POST')
            .then(function (response) {
                location.href = location_url;
            })
            .catch(function (err) {
                var str = '';
                if (err.response.data.errors != undefined) {
                    $.each(err.response.data.errors, function (i, n) {
                        str += "<span>" + n[0] + "</span><br/>";
                        $("input[name='" + i + "']").parents('li').css("border-color", "#f04042");
                    });
                    $('.check_info_box .error_msg').show().children('p').html(str);
                    $(".submit").children('a').text("立即登录");
                    $(".submit").children(".wait").hide();
                    UpCode();
                } else {
                    $('.check_info_box .error_msg').show().children('p').html("网络错误！！");
                }

            })
        ;
    });
    // $("#sub").on("click",function(){
    //     var zhanghao=$("input[name='username']").val();
    //     var pwd=$("input[name$='password']").val();
    //     var code=$("input[name$='code']").val();
    //     HideTip();
    //     HideBorder();
    //     $(".submit").children('a').text("");
    //     $(".submit").children(".wait").show();
    //     $.post(loginurl,{username:zhanghao,password:pwd,code:code},function(msg){
    //         if(msg.status=='true'){
    //             // history.back(-1);
    //             location.href='/index.html';
    //             // self.location=window.document.referrer;
    //         }else{
    // 	    $(".submit").children('a').text("立即登录");
    //             $(".submit").children(".wait").hide();
    //             $('.check_info_box .error_msg').show().children('p').html(msg.info);
    //             var Type = msg.info;
    //             if(Type == "用户名不能为空"){
    //                 $(".name").parents('li').css("border-color","#f04042");
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //             }else if(Type == "密码不能为空"){
    //                 $(".pwd").parents('li').css("border-color","#f04042");
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //             }else if(Type == "验证码不能为空"){
    //                 $(".code").parents('li').css("border-color","#f04042");
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //             }else if(Type == "验证码错误或过期"){
    //                 $(".code").parents('li').css("border-color","#f04042");
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //                 UpCode();
    //             }else if(Type == "用户名或者密码错误"){
    //                 $(".name").parents('li').css("border-color","#f04042");
    //                 $(".pwd").parents('li').css("border-color","#f04042");
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //                 UpCode();
    //             }else if(Type == "该用户未认证或者该用户已被冻结,请联系管理员"){
    //                 $(".submit").children('a').text("立即登录");
    //                 $(".submit").children(".wait").hide();
    //                 UpCode();
    //             }
    //         }
    //     }, 'json').error(
    //         function () {
    //             //  其他错误信息
    //             $('.check_info_box .error_msg').show().children('p').html("网络连接错误，请稍后重试");
    //             $(".submit").children('a').text("立即登录");
    //             $(".submit").children(".wait").hide();
    //         }
    //     );
    // });

    $(document).keypress(function (e) {
        // 回车键事件
        if (e.which == 13) {
            jQuery("#sub").click();
        }
    });


});


