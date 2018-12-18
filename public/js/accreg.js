/**
* Created by Administrator on 2016/7/26.
*/
$(function(){
//username.blur(function(){
//    if(username.val()==''){
//        layer.tips("账号不能为空",username);
//    }
//
//});
// pwd.blur(function(){
//        if(pwd.val()==''){
//            layer.tips("密码不能为空",pwd);
//            return false;
//        }
//    });
//pwd1.blur(function(){
//        if(pwd1.val()==''){
//            layer.tips("确认密码不能为空",pwd1);
//            return false;
//        }else{
//            if(pwd1.val()!=pwd.val()) {
//                layer.msg("两次密码不一致", {icon:2});
//                return false;
//            }
//        }
//    });
username.change(function(){
$.post(eurl,{username:username.val().trim()},function(msg){
if(msg.status=='ok'){
    layer.tips(msg.info,username);
}else{
    layer.tips(msg.info,username,{time:6000});username.val("");username.focus();
}
});
});
usub.click(function(){
$.post(uurl,{username:username.val().trim(),password:pwd.val().trim(),repassword:pwd1.val().trim(),code:code.val().trim()},function(data){
if(data.status=='code'){
layer.tips(data.info,code);
return false;
}
if(data.status=='true'){
layer.msg(data.info, {icon: 1});
window.location.href="check_infos";
}else{
    a.parent('li').css({"margin-bottom":"30px","border-color":"red"});
    a.siblings('.error_msg').show().children('p').html(data.info);
//layer.msg(data.info,{time:3000,icon: 2});
}
}, 'json').error(function(){
layer.msg("发生错误", {icon: 2},{time:6000});
});
});
});