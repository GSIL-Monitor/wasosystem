/**
 * Created by john on 2016/12/29.
 */

function hideError(a){a
    a.css("border-color","#999");
    a.siblings(".error").remove();
}

function showError(a,text){
    hideError(a);
    a.css("border-color","#D64D4A");
    a.parents(".liRight").append("<div class='error'>"+text+"</div>");
    a.parents(".liRight").find('.error').not(":last").remove();
    a.siblings('.suc_msg').hide();
    a.siblings('.error_msg').show().children('p').html(text);
}



function check_u(a,data){
    $.post(check_uurl,{"username":data},function (msg) {
        if(msg.sta=='ok'){
            showError(a,msg.info);
        }else{
            hideError(a)
        }
    });
}

function check_p(a,data){
    $.post(check_purl,{"mobile":data},function (msg) {
        if(msg.sta=='ok'){
            showError(a,msg.info);
        }else{
            hideError(a)
        }
    });
}

function check_e(data){
    $.post(check_eurl,{"email":data},function (msg) {
        if(msg.sta=='ok'){
            showError(a,msg.info);
        }else{
            hideError(a)
        }
    });
}

function checkNum(a){
    var s=a.val();
    var reg = new RegExp("^[0-9]*$");
    if(!reg.test(s)){
        showError(a,"请输入数值");
        return false;
    }else{
        hideError($(this));
    }
}


function checkMail(a){
    var s=a.val();
    var reg = /^[1-9][0-9]{5}$/;
    if(!reg.test(s)){
        showError(a,"邮编格式不正确");
        return false;
    }else{
        hideError($(this));
    }
}

function checkMobile(a){
    var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
    var isMob = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;

    if( isPhone.test(a.val()) == false && isMob.test(a.val())==false){
        showError(a,"号码不正确");
        return false;
    }else{
        hideError($(this));
    }
}

function checkEmail(a) {
    if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
        showError(a,"邮箱不正确");
        return false;
    }else{
        hideError($(this));
    }
}

function checkPhone(a) {
    if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
        showError(a,"号码不正确");
        return false;
    }else{
        hideError($(this));
    }
}

function checkQQ(a){
    var pattern = /[1-9]([0-9]{5,11})/;
    if (pattern.test(a.val())) {
        hideError($(this));
    } else {
        showError(a,"QQ号码不正确");
        return false;
    }
}

function checkUserName(a){
    var s=a.val().length;
    if (/^[a-zA-z0-9\u4E00-\u9FA5]+$/.test(a.val()) == false){
        showError(a,"用户名不能含有特殊字符");
        return false;
    }else{
        if(s<4|| s>10){
            showError(a,"请输入4-10位用户名");
            return false;
        } else {
            hideError($(this));
            checkBeforeName($(this));
        }
    }
}

function checkWeb(a){
    var pattern = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
    if (pattern.test(a.val())) {
        hideError(a);
    } else {
        showError(a,"网站地址不正确");
    }
}

function checkPwd(a){
    if (/^[a-zA-Z0-9_]{0,}$/.test(a.val()) == false) {
        showError(a,"密码只能由英文、数字组成");
        return false;
    } else {
        hideError(a);
        if (a.val().length < 6 || a.val().length > 20) {
            showError(a,"请输入6-20位密码");
            return false;
        } else {
            hideError(a);
        }
    }
}

function checkPwdAgian(a){
    var PWD1 = $('.newPwd').val();
    var PWD2 = a.val();
    if (PWD1 == "" || PWD1 == " ") {
        checkNull($('.newPwd'));
        showError(a,"两次密码不一致");
        return false;
    } else {
        hideError(a);
        if (PWD1 != PWD2) {
            showError(a,"两次密码不一致");
            return false;
        } else {
            hideError(a);
        }
    }
}

function checked(a){
    if(a.has(".checkboxs")){
        var checkedNum = a.find("input[type='checkbox']:checked").length;
        if(checkedNum==0){
            showError(a,"必须选择一个选项");
            return false;
        }else {
            hideError(a);
        }
    }
}


function checkError(a) {
    var result = "no";
    var step = 0;
    var totalStep = a.find("li").length;
    a.find("li").each(function(){
        $(this).find(".checkNull").not(":disabled").trigger("blur");
        checked($(this).find(".checkboxs"));
        step++;
        if(step==totalStep){
            if($("div").hasClass("error")){
                return result = "no";
                return false;
            }else{
                return result = "ok";
            }
        }
    });
    return result;
}
    function add_form(action,method,form_data,form_id,location){
        // console.log(method);  console.log(action); console.log(form_id);
        // console.log(form_data);
        $("button[form_id='"+form_id+"']").attr('disabled',true)
        $(window.top.document).find(".loadPage").not(":hidden").children(".loadingWeb").show();
        axios.post(action,form_data).then(function(response) {
             toastrMessage('success',response.data.info,location)
        }).catch(function(err) {
            if(err.response.data.info){
               toastrMessage('error',err.response.data.info)
            }
                if(err.response.data.errors !=undefined){
                    $.each(err.response.data.errors,function (name,errMsg) {
                        var names=name.split('.');
                      //  console.log(names[0]);
                        if(names.length>1){
                            if($('select[name="'+names[0]+'[]"]').length >=1){
                                showError($('select[name="'+names[0]+'[]"]'),errMsg[0]);
                                showError($('input[name="'+names[0]+'[]"]'),errMsg[0]);
                                if($('select[name="'+names[0]+'[]"]').length >1){
                                    //保留最后一个错误
                                    $('select[name="'+names[0]+'[]"]').parent().siblings(".error").not(":last").remove();
                                }
                            }else{
                                showError($('input[name="'+names[0]+'['+names[1]+']"]'),errMsg[0]);
                                showError($('select[name="'+names[0]+'['+names[1]+']"]'),errMsg[0]);
                                showError($('input[name="'+names[0]+'[]"]'),errMsg[0]);
                            }
                        }else{
                            showError($('input[name="'+name+'"]'),errMsg);
                            showError($('select[name="'+name+'"]'),errMsg);
                            showError($('textarea[name="'+name+'"]'),errMsg);
                            if(name =='code'){
                                swal(errMsg[0],
                                    '请根据提示操作！',
                                    'warning')
                            }
                        }

                    });
                }else{
                    swal(err.response.data.message,
                        '请根据提示操作！',
                        'warning')

                }
            $(window.top.document).find(".loadPage").not(":hidden").children(".loadingWeb").hide();
            });
    }
//公共添加表单
// function add_form() {
//     console.log(111);
//     var add_rule_form = $(".Add_form").parent("form").fixedSerialize();
//
//     layer.msg('正在保存中...', {
//         icon: 16,shade: 0.01,time:500
//     },function(index){
//         $.post(add_form_url, add_rule_form, function (data) {
//             if (data.sta == 'ok') {
//                 layer.msg(data.info, {icon: 6});
//                 parent.location.reload();
//             } else {
//                 if (data.data) {
//                     $.each(data.data, function (key, msg) {
//                         if (key == 'a16') {
//                             $(".Add_form #edui1").css("border-color", "#dd4e4e").show();
//                             layer.msg(msg, function () {
//
//                             });
//                         }
//                         $(".Add_form select[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
//                         $(".Add_form input[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
//                     });
//                 }
//                 if (data.info) {
//                     layer.msg(data.info, function () {
//
//                     });
//                 }
//                 return false;
//             }
//         });
//     });
//
// }



$(document).ready(function(){
    function checkNull(a){
        if(a.val()=="" || a.val()==" " ){
            if(a.hasClass("checkNull")){
                showError(a,"不能为空");
            }
            return false;
        }else{
            hideError(a);
        }
    }

    //判断是是否存在username、
    $(document).on("blur", "form .username", function () {
        var val=$(this).val();
        if(checkNull($(this))!=false) {
            if (val.length >= 2) {
                check_u($(this), val);
            } else {
                showError($(this), "账号必须大于两位");
            }
        }
    });
    //判断是是否存在mobile、
    $(document).on("blur", "form .mobile", function () {
        var val = $(this).val();
        if(checkNull($(this))!=false) {
            if (checkMobile($(this)) != false) {
                check_p(val);
            }
        }
    });
    //判断是是否存在email、
    $(document).on("blur", "form .email", function () {
        var val=$(this).val();
        if(checkNull($(this))!=false) {
            if (checkEmail($(this)) != false) {
                check_e(val);
            }
        }
    });

    $(document).on("change", ".checkboxs input", function () {
        var checkedNum = $(this).parents(".checkboxs").find("input[type='checkbox']:checked").length;
        if(checkedNum>0) {
            hideError($(this));
        }
    });

    $(document).on("focus","input,select,textarea",function(){
        hideError($(this));
    });

    $(document).on("blur",".checkNull",function(){
        checkNull($(this));
    });
    $(document).on("blur",".checkNum",function(){
        if(checkNull($(this))!=false){
            checkNum($(this));
        }else{
            return false;
        }
    });
    $(document).on("blur",".checkUserName",function(){
        if (checkNull($(this)) != false) {
            checkUserName($(this));
        }
    });
    $(document).on("blur",".checkOldPwd",function(){
        if (checkNull($(this)) != false) {
            checkPwd($(this));
        }
    });
    $(document).on("blur",".checkPwd",function(){
        if (checkNull($(this)) != false) {
            checkPwd($(this));
            checkPwdAgian($('.pwdAgian'));
        }
    });
    $(document).on("blur",".checkMobile",function(){
        if (checkNull($(this)) != false) {
            checkMobile($(this));
        }
    });
    $(document).on("blur",".checkPhone",function(){
        if (checkNull($(this)) != false) {
            checkPhone($(this));
        }
    });
    $(document).on("blur",".checkWeb",function(){
        if (checkNull($(this)) != false) {
            checkWeb($(this));
        }
    });
    $(document).on("blur",".checkQQ",function(){
        if (checkNull($(this)) != false) {
            checkQQ($(this));
        }
    });
    $(document).on("blur",".checkEmail",function(){
        if (checkNull($(this)) != false) {
            checkEmail($(this));
        }
    });
    $(document).on("blur",".checkMail",function(){
        if (checkNull($(this)) != false) {
            checkMail($(this));
        }
    });
    $(document).on("blur",".checkPwdAgian",function(){
        if (checkNull($(this)) != false) {
            checkPwdAgian($(this));
        }
    });

    /*  提交按钮  */
    // $(document).on("click",".confirm",function() {
    //     var obj = $(this).parents(".nowWebBox").find(".Add_form");
    //     if(checkError(obj) == "ok" ){
    //         add_form()
    //     }else if(checkError(obj) == "no"){
    //         return false;
    //     }else{
    //         return false;
    //     }
    // });
});