/**
 * Created by Administrator on 2016/7/26.
 */
$(function(){

    username.change(function(){
        $.post(eurl,{username:username.val().trim()},function(msg){
            if(msg.status=='ok'){
                layer.msg(msg.info, {icon: 1});
            }else{
                layer.msg(msg.info, {icon: 2},{time:6000});email.val("");email.focus();
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
                layer.msg(data.info, {icon: 2});
                window.location.href="register_wait";
            }else{
                layer.msg(data.info,{time:3000,icon: 2});
            }
        }, 'json').error(function(){
            layer.msg("发生错误", {icon: 2},{time:6000});
        });
    });
});