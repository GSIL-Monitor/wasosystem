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
    $(".self_sub").on("click",function(){
        $('.person_info ul .canChange input').attr("disabled","true").css({"background":"#f7f7f7","color":"#999"});
        $('.person_info ul .canChange select').attr("disabled","true").css({"background":"#f7f7f7","color":"#999"});
        $(this).hide();
        $(".person_info .self_btn").show();
    });

    //暂时隐藏错误信息
    $('.person_info li input').on("focus",function(){
        hideTip2($(this));
    });

    //邮箱
    $('.email_text').on("blur",function(){
        if(checkNull($(this))!=false){
            checkEmali($(this));
        }
    });

    //电话
    $('.phone_text').on("blur",function(){
        if(checkNull($(this))!=false){
            checkPhone($(this));
        }
    });

    //检查是否为数字
    $('.checkNum').on("blur",function(){
        if(checkNull($(this))!=false){
            checkNum($(this));
        }
    });

    //提交
    $('.self_sub').bind("click",function(){
        if(checkNull($(this).siblings('ul').children('li').children('input'))!=false){
            if(checkError($(this))!=false){
                var sex=$('input:radio[name="sex"]:checked').val();
                var form={};
                $.each($('.tab').find('input'),function(i){
                  var name=$(this).attr('name');
                  var value=$(this).val();
                    if(name&&value){
                        form[name]=value ;
                    }
                });
                $.get(url,{form:form,sex:sex},function(data){
                     if(data=='1'){
                         layer.confirm("个人信息已更新", {
                             btn: ['确定','取消'] //按钮
                         },function(){
                             location.reload();
                         });
                     }else{
                         layer.confirm("修改失败", {
                             btn: ['确定','取消'] //按钮
                         });
                     }
                });
                hideTip($(this));
            }
        }
    });









});







