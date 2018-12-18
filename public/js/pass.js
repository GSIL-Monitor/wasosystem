/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
    /*  隐藏提示 */
    function hideTip(a) {
        a.parent('li').css({"border-color": "#dedede"});
        a.siblings('.error_msg').hide();
    };

    /*  检查是否为空 */
    function checkNull(a) {
        if (a.val() == "" || a.val() == " ") {
            a.parent('li').css("border-color","red");
            a.siblings('.error_msg').show().children('p').html("不能为空");
            return false;
        } else {
            hideTip(a);
        }
    };

    /*  检查手机、座机号码*/
    function checkPhone(a){
        var isPhone = /^1[34578]\d{9}$/;
        if( isPhone.test(a.val()) == false){
            a.parent('li').css("border-color","red");
            a.siblings('.error_msg').show().children('p').html("电话号码不正确");
            return false;
        }else{
            hideTip(a);
        }
    };

    /*  检查邮箱 */
    function checkEmail(a) {
        if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
            a.parent('li').css("border-color","red");
            a.siblings('.error_msg').show().children('p').html("邮箱格式不正确");
            return false;
        }else{
            hideTip(a);
        }
    };

    /*   取消编辑 */
    function Cancel(){
        if(confirm("未提交信息将不会保存！")!=false){
            location.href=loa_url;
        }
    }


    /*  判断验证码 */
    function checkCode(a) {
        var code = $(".code").val();
        $.post(uurl, {code: code}, function (data) {
            if (data == '2') {
                a.parent('li').css("border-color","red");
                a.siblings('.error_msg').show().children('p').html("验证码错误");
                return false;
            }else{
                SucTip(a);
                hideTip(a);
            }
        });
    }

    /*  整体检测有无错误 */
    function checkError(a) {
        var val = "";
        a.children('li').each(function(){
            $(this).children("input").trigger("blur");
            if(checkNull($(this).children('input'))==false){
                val = false;
            }else{
                $(this).children("input").trigger("blur");
                if(a.find(".error_msg").is(":visible")){
                    return false;
                    val = false;
                }else{
                    val = true;
                }
            }
        });
        if(a.find(".error_msg").is(":visible")){
            val = false;
        };
        return val;
    }

    //发送验证码倒计时
    function send() {
        var time = 30;
        function timeCountDown() {
            if (time == 0) {
                clearInterval(timer);
                $('.repSend').addClass('canSend').removeClass('waitSend').html("重新发送");
                return true;
            } else {
                $('.repSend').addClass('waitSend').removeClass('canSend').html(time + "s 后可发送");
                time--;
                return false;
            }
        }
        timeCountDown();
        var timer = setInterval(timeCountDown, 1000);
    }

    $('.repSend').on("click", function () {
        if ($(this).hasClass('canSend')) {
            var type = $(this).attr("name");
            if(type == "mobile"){
                var Check = checkPhone($(this).parents("li").siblings("li").children("input"));
            }else{
                var Check = checkEmail($(this).parents("li").siblings("li").children("input"));
            }
            if(Check!=false){
                send();
                var mobile = $(".mobile:visible").val();
                var email = $(".email:visible").val();
                if(type=='mobile'){
                    var data= {mobile: mobile,type:type}
                }else if(type=='email'){
                    var data= {email: email,type:type}
                }
                SendMsg(data);
            } else {
                return false;
            }
        }
    });

    /*   发送验证信息  */
    function SendMsg(data){
        $.get('../Register/check_code.html', data , function (data) {
            if (data == "1") {
                hideTip($(this));
            } else{
                alert("信息发送失败");
            }
        });
    }







    /*  隐藏错误信息 */
    $('.safeUl li input').on("focus", function () {
        hideTip($(this));
    });



    /*  邮箱地址判断 */
    $('.email').on("keyup",function(){
        if(checkNull($(this))!=false) {
            checkEmail($(this));
        }
    });
    $('.email').on("blur",function(){
        $(this).trigger("keyup");
    });



    //手机号码判断
    $('.mobile').on("keyup", function () {
        if ($(this).val() != "" && $(this).val() != " ") {
            checkPhone($(this));
        }
    });
    $('.mobile').on("blur", function () {
        $(this).trigger("keyup");
    });




   $(".safe .setNew").on("click",function(){
       if($(".safe").find(".editNum").is(":visible")){
           if(confirm("未提交的信息不会被保存！")!=false){
               location.href="../Person/pass.html";
           }
       }else{
           var val = $(this).attr("name");
           $("#black").fadeIn(200);
           $(".checkUser").show();
           $(".checkUser .types").val(val);
       }
   });
    /*   新绑定  */


    $(".safe .editOld").on("click",function(){
        if($(".safe").find(".editNum").is(":visible")){
            if(confirm("未提交的信息不会被保存！")!=false){
                location.href="../Person/pass.html";
            }
        }else{
            var val = $(this).attr("name");
            if(val == "email"){
                $('.emailBox').show().siblings(".nowInfo").hide();
                $('.emailBox .checkCode').show();
            }else{
                $('.mobileBox').show().siblings(".nowInfo").hide();
                $('.mobileBox .checkCode').show();
            }
        }
    });
    /*   修改  */




    $('.goStep1').on("click",function(){
        if(checkError($(this).siblings('.safeUl'))!=false){
            var type = $(".checkUser .types").val();
            var curl="../Person/pwdcheck.html";//检查旧密码
            var Pwd=$(this).siblings('.safeUl').children("li").children("input[name='Pwd']");
            $.post(curl,{oldpwd:Pwd.val().trim()},function(data){
                if(data.status=='no'){
                    $(".Pwd").parent('li').css({"border-color":"red"});
                    $(".Pwd").siblings('.error_msg').show().children('p').html("密码错误");
                    return false;
                }else{
                    $(".checkUser").hide();
					$("#black").fadeOut(200);
                    if(type == "email"){
                        $('.safe .emailBox').show().siblings('.nowInfo').hide();
                        $(".safe .emailBox .SetNew").show();
                    }else{
                        $('.safe .mobileBox').show().siblings('.nowInfo').hide();
                        $(".safe .mobileBox .SetNew").show();
                    }
                }
            });
        }
    });
    /*  添加新绑定 */




    $('.safe .goStep2').on("click",function(){
        if(checkError($(this).siblings('.safeUl'))!=false){
            var phonecode=$('.MobileCode:visible').val();
            var emialcode=$('.EmailCode:visible').val();
            var sta=1;
            var type=$(this).attr('name');
            if(type=='mobile'){
                var data= {code:phonecode,sta:sta,type:type}
            }else if(type=='email'){
                var data= {code:emialcode,sta:sta,type:type}
            }
            $.get('../Register/check_code.html',data,function(data) {
                if (data != "1") {
                    $('.EmailCode:visible').parent('li').css("border-color", "#f00");
                    $('.EmailCode:visible').siblings('.error_msg').show().children('p').html("验证码错误");
                    $('.MobileCode:visible').parent('li').css("border-color", "#f00");
                    $('.MobileCode:visible').siblings('.error_msg').show().children('p').html("验证码错误");
                    return false;
                }else{
                    if(type == "email"){
                        $('.emailBox:visible').children('.checkCode').hide().siblings(".SetNew").show();
                    }else{
                        $('.mobileBox:visible').children('.checkCode').hide().siblings(".SetNew").show();
                    }
                }
            });
        }
    });
    /*  验证码通过 */


    $('.safe .goStep3').on("click",function(){
        if(checkError($(this).siblings('.safeUl'))!=false){
            var phonecode=$('.MobileCode:visible').val();
            var emialcode=$('.EmailCode:visible').val();
            var sta=1;
            var type=$(this).attr('name');
            if(type=='mobile'){
                var data= {code:phonecode,sta:sta,type:type}
            }else if(type=='email'){
                var data= {code:emialcode,sta:sta,type:type}
            }
            $.get('../Register/check_code.html',data,function(data) {
                if (data != "1") {
                    $('.EmailCode:visible').parent('li').css("border-color", "#f00");
                    $('.EmailCode:visible').siblings('.error_msg').show().children('p').html("验证码错误");
                    $('.MobileCode:visible').parent('li').css("border-color", "#f00");
                    $('.MobileCode:visible').siblings('.error_msg').show().children('p').html("验证码错误");
                    return false;
                }else{
                    alert("绑定成功");
                    location.href="../Person/pass.html";
                }
            });
        }
    });
    /*  验证码通过 */



    $(".safe .cancel").on("click",function(){
        Cancel();
    });
    $(".checkUser .cancel").on("click",function(){
        $(".checkUser").hide();
        $("#black").fadeOut(200);
    });
    $("#black").on("click",function(){
        $(".checkUser").hide();
        $("#black").fadeOut(200);
    });
    /*  取消 */




});







