/**
 * Created by john on 2016/11/2.
 */
$(document).ready(function(){
    /*  隐藏提示 */
    function hideTip(a){
        a.css("border-color","#dedede");
        a.siblings('.error_msg').hide();
    };


    /*  正确提示  */
    function SucTip(a){
        hideTip(a);
        a.siblings(".suc_msg").show();
    }


    /*  检查是否为空 */
    function checkNull(a){
        if(a.val()=="" || a.val()==" "){
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("不能为空");
            return false;
        }else{
            hideTip(a);
            SucTip(a);
        }
    };


    /*  检查邮箱 */
    function checkEmali(a){
        if(/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/.test(a.val()) == false){
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("邮箱格式不正确");
            return false;
        }else{
            SucTip(a);
            hideTip(a);
        }
    };

    /*  检查网址*/
    function checkWeb(a){
        var pattern = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
        if (pattern.test(a.val())) {
            SucTip(a);
            hideTip(a);
        } else {
            a.parent('li').css({"border-color":"red"});
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("网站地址不正确");
        }
    };

    /*  检查手机、座机号码*/
    function checkPhone(a){
        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
        var isMob = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
        if( isPhone.test(a.val()) == false && isMob.test(a.val())==false){
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("电话号码不正确");
            return false;
        }else{
            SucTip(a);
            hideTip(a);
        }
    };

    /*  检查是否为数字 */
    function checkNum(a){
        var pattern = /^([0-9]+)$/;
        if (pattern.test(a.val())) {
            SucTip(a);
            hideTip(a);
        } else {
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("数字格式不正确");
        }
    };

    /*  检查邮编 */
    function checkMail(a){
        var pattern = /\d{6}/;
        if (pattern.test(a.val())) {
            SucTip(a);
            hideTip(a);
        } else {
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("邮政编码不正确");
        }
    };

    /*  检查是否有内容 */
    function checkTxt(a){
        if(a.val()=="" || a.val()==" "){
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("不能为空");
            return false;
        }else{
            hideTip(a);
            SucTip(a);
        }
    };

    /*  检查QQ */
    function checkQQ(a){
        var pattern = /[1-9]([0-9]{5,11})/;
        if (pattern.test(a.val())) {
            SucTip(a);
            hideTip(a);
        } else {
            a.css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("QQ号码不正确");
        }
    };







    /*  判断是否为空 */
    $(".tab input").live("keyup",function(){
        if(checkNull($(this))!=false) {
            checkNull($(this));
        }
    });
    $(".tab input").live("blur",function(){
        $(this).trigger("keyup");
    });

    /*  判断是否有内容 */
    $(".tab .words input").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkTxt($(this));
        }
    });
    $(".tab .words input").live("blur",function(){
        $(this).trigger("keyup");
    });

    /*  判断手机号码   座机号码 */
    $(".tab .phoneMob input").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkPhone($(this));
        }
    });
    $(".tab .phoneMob input").live("blur",function(){
        $(this).trigger("keyup");
    });

    /*  判断邮政编码 */
    $(".tab .mail input").live("keyup",function(){
        if(checkNull($(this))!=false) {
            checkMail($(this));
        }
    });
    $(".tab .mail input").live("blur",function(){
        $(this).trigger("keyup");
    });

    /*  判断网站地址 */
    $(".tab .web input").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkWeb($(this));
        }
    });
    $(".tab .web input").live("blur",function(){
        $(this).trigger("keyup");
    });

    /*  判断是否为数字 */
    $(".tab .num input").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkNum($(this));
        }
    });
    $(".tab .num input").live("blur",function(){
        $(this).trigger("keyup");
    });





});
