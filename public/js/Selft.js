/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

    /*   个人信息修改  */
    $(".self_btn").on("click",function(){
        $('.person_info ul .canChange input').removeAttr("disabled").attr("disabled",false).css({"background":"#fff","color":"#333"});
        $('.person_info ul .canChange select').removeAttr("disabled").attr("disabled",false).css({"background":"#fff","color":"#333"});
        $(this).hide();
        $(".person_info .self_sub").show();
    });

    /*  点击显示提示 */
    function hideTip(a){
        a.parents('li').css("border-color","#dedede");
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
            a.parents('li').css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("不能为空");
            return false;
        }else{
            hideTip(a);
        }
    };

    /*  检查邮箱 */
    function checkEmali(a){
        if(/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/.test(a.val()) == false){
            a.parents('li').css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("邮箱格式不正确");
            return false;
        }else{
            SucTip(a);
            hideTip(a);
        }
    };

    /*  检查手机、座机号码*/
    function checkPhone(a){
        var isMob = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
        var isPhone = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
        if( isPhone.test(a.val()) == false && isMob.test(a.val())==false){
            a.parents('li').css("border-color","red");
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
            a.parents('li').css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("数字格式不正确");
        }
    };

    /*  检查是否有内容 */
    function checkTxt(a){
        if(a.val()=="" || a.val()==" "){
            a.parents('li').css("border-color","red");
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
            a.parents('li').css("border-color","red");
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("QQ号码不正确");
        }
    };


    /*  整体检测有无错误 */
    function checkError(a){
        var val = "";
        a.children('.MustW').each(function(){
            $(this).children("input").trigger("blur");
            if(checkNull($(this).children('input'))==false){
                val = false;
            }else{
                a.children('li').children("input").trigger("blur");
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
        }
        return val;
    }








    //暂时隐藏错误信息
    $('.tab_box li input').on("focus",function(){
        hideTip($(this));
    });


    /*  邮箱  */
    $('.email_text').live("keyup",function(){
        if(checkNull($(this))!=false){
            checkEmali($(this));
        }
    });
    $('.email_text').live("blur",function(){
       $(this).trigger("keyup");
    });


    //检查QQ
    $('.checkQQ').live("keyup",function(){
        if(checkNull($(this))!=false){
            checkQQ($(this));
        }
    });
    $('.checkQQ').live("blur",function(){
        $(this).trigger("keyup");
    });


    /*  判断手机号码   座机号码 */
    $(".phoneMob").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkPhone($(this));
        }
    });
    $(".phoneMob").live("blur",function(){
        $(this).trigger("keyup");
    });


    /*  判断邮政编码 */
    $(".tab .mail input").live("keyup",function(){
        if(checkNull($(this))!=false){
            checkPhone($(this));
        }
    });
    $(".tab .mail input").live("blur",function(){
        $(this).trigger("keyup");
    });


    /*  判断是否有内容 */
    $(".tab .words input").live("keyup",function(){
        checkTxt($(this));
    });
    $(".tab .words input").live("blur",function(){
        $(this).trigger("keyup");
    });





    //提交
    $('.self_sub a').on("click",function(){
        if(checkError($(this).parents(".button").siblings(".tab").children('form'))!=false){
                // var sex=$('input:radio[name="sex"]:checked').val();
                // var infotype=$('input:radio[name="infotype"]:checked').val();

                var form=$('.tab form').serialize();
                var url="../Person/self.html";
                $.get(url,form,function(data){
                    if(data=='1'){
                        alert("修改成功");
                        window.location.reload();
                    }else{
                        $(".check_info_box p").html("修改失败,您没有做任何修改,请重试");
                        $(".tab li .suc_msg").hide();
                    }
                });
                hideTip($(this));
            $('.person_info ul .canChange input').attr("disabled","true").css({"background":"#f7f7f7","color":"#999"});
            $('.person_info ul .canChange select').attr("disabled","true").css({"background":"#f7f7f7","color":"#999"});
            $(".person_info .self_btn").show();
        }
    });
















});







