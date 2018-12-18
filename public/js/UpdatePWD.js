/**
 * Created by john on 2016/11/1.
 */


$(document).ready(function(){
    var oldpwd=$("input[name='oldpwd']");

   /*  隐藏全部错误信息 */
    function HideTip(){
		$(".error_msg").hide();
	    $("input[type='password']").css("border-color","#dedede");
    }
	

    /*  隐藏单个错误信息 */
    function hideTip(a){
        a.css({"border-color":"#dedede"});
        a.siblings('.error_msg').hide();
    }

    /*  正确提示  */
    function SucTip(a){
        hideTip(a);
        a.siblings(".suc_msg").show();
    }
	
	 /*  取消红线 */
    $('li input').on("focus",function(){
         hideTip($(this));
    });


    /*  检查是否为空 */
    function checkNull(a){
        if(a.val()=="" || a.val()==" "){
            a.css({"border-color":"red"});
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("不能为空");
            return false;
        }
    }


    /*  检查密码格式 */
    function checkPwd(a){
        if(/^[a-zA-Z0-9_]{0,}$/.test(a.val())==false) {
            a.css({"border-color": "red"});
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("密码只能由英文，数字组成");
            return false;
        }else{
            hideTip(a);
            if (a.val().length < 6 || a.val().length > 20) {
                a.css({"border-color":"red"});
                a.siblings('.suc_msg').hide();
                a.siblings('.error_msg').show().children('p').html("请输入6-20位密码");
                return false;
            }else{
                SucTip(a);
                hideTip(a);
            }
        }
    }

    /*  检查密码两次是否一样 */
    function checkPwdTure(a){
        var PWD1 = $('li .pwd1').val();
        var PWD2 = a.val();
        if(PWD1=="" || PWD1==" "){
            checkNull($('li .pwd1'));
            a.css({"border-color":"red"});
            a.siblings('.suc_msg').hide();
            a.siblings('.error_msg').show().children('p').html("两次密码不一致");
            return false;
        }else{
            hideTip(a);
            if(PWD1 != PWD2){
                a.css({"border-color":"red"});
                a.siblings('.suc_msg').hide();
                a.siblings('.error_msg').show().children('p').html("两次密码不一致");
                return false;
            }else{
                SucTip(a);
                hideTip(a);
            }
        }
    }


    /*  整体检测有无错误 */
    function checkError(){
		$("li").each(function(){
			$(this).find("input").trigger("keyup");
		});
        if($('ul').find(".error_msg").is(":visible")){
            return false;
        }else{
            return true;
        }
    }





    /*  原始密码判断 */
    var curl="../Person/pwdcheck.html";//检查旧密码
    $(document).on("keyup",".pwd_old",function(){
		if(checkNull($(this))!=false){
			$.post(curl,{oldpwd:oldpwd.val().trim()},function(data){
				if(data.status=='no'){
					$(".pwd_old").css({"border-color":"red"});
					$(".pwd_old").siblings('.suc_msg').hide();
					$(".pwd_old").siblings('.error_msg').show().children('p').html("旧密码错误");
				}else{
					SucTip($(".pwd_old"));
				}
			});			
		}
    });
    $(".pwd_old").live("blur",function(){
       $(this).trigger("keyup");
    });



    /*  登录密码判断 */
    $('.pwd1').on("keyup",function(){
        if(checkNull($(this))!=false){
            checkPwd($(this));
            checkPwdTure($('.tab_box .pwd2'));
        }
    });
    $('.pwd1').on("blur",function(){
        $(this).trigger("keyup");
    });


    /*  确认密码判断 */
    $('.pwd2').on("keyup",function(){
        if(checkNull($(this))!=false){
            checkPwdTure($(this));
        }
    });
    $('.pwd2').on("blur",function(){
        $(this).trigger("keyup");
    });


    /*  提交信息 */
    var eurl="../Person/pwdedit.html";//检查旧密码
    $('.goStep3').on("click",function(){
        HideTip();
		if(checkError()==true){
            $.post(eurl,{newpwd:$("input[name='newpwd']").val()},function(data){
               if(data.status=='no'){
                  $(".check_info_box p").html("修改失败，请重试");
              }else{
                 alert("密码修改成功，请重新登录");
                 window.location.href="../Login/logout.html";
              }
            });		
		}else{
           return false;			
		}
    });





});

