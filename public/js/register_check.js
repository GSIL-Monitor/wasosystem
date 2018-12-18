/**
 * Created by john on 2016/7/8.
 */

/*  更新验证码 */
var eurl="../Register/regEmailPost.html";
var uurl="../Register/check_yzm.html";


function UpCode() {
    $(".code_pic img").trigger("click");
}


/*  隐藏单个提示 */
function hideTip(a) {
    a.parents('li').css({"border-color": "#dedede"});
    a.parents('label').siblings('.error_msg').hide();
}


/*  正确提示  */
function SucTip(a) {
    hideTip(a);
    a.parents('label').siblings(".suc_msg").show();
}


/*  检查是否为空 */
function checkNull(a) {
    if (a.val() == "" || a.val() == " ") {
        a.parents('li').css("border-color","#f04042");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("不能为空");
        return false;
    }
}

/*  检查是否有内容 */
function checkTxt(a){
    if(a.val()=="" || a.val()==" "){
        a.parents('li').css("border-color","#f04042");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("不能为空");
        return false;
    }else{
        hideTip(a);
        SucTip(a);
    }
}


/*  检查网址*/
function checkWeb(a){
    var pattern = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color":"#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("网站地址不正确");
    }
}


//判断是否被注册
function check_name(a){
    var types = a.attr("name");
    if(types == "username"){
		if(/^[a-zA-z0-9\u4E00-\u9FA5]+$/.test(a.val()) == false) {
			a.parents('li').css({"border-color": "#f04042"});
			a.parents('label').siblings('.suc_msg').hide();
			a.parents('label').siblings('.error_msg').show().children('p').html("用户名不能含有特殊字符");
			return false;
		} else {
			var len = a.val().replace(/[^\x00-\xff]/g, "**").length;
			if (len < 4 || len > 10) {
				a.parents('li').css({"border-color": "#f04042"});
				a.parents('label').siblings('.suc_msg').hide();
				a.parents('label').siblings('.error_msg').show().children('p').html("用户名在4至10位字符");
				return false;
			} else {
				$.post('../Register/regEmailPost.html',{username:a.val()},function(data){
					if(data.status=='no'){
						a.parents('li').css({"border-color": "#f04042"});
						a.parents('label').siblings('.suc_msg').hide();
						a.parents('label').siblings('.error_msg').show().children('p').html("用户名已注册");
						return false;
					}else{
						SucTip(a);

						hideTip(a);
					}
				});
			}
		}

    }else if(types == "mobile"){
    if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
            a.parents('li').css({"border-color": "#f04042"});
            a.parents('label').siblings('.suc_msg').hide();
            a.parents('label').siblings('.error_msg').show().children('p').html("电话号码不正确");
            return false;
        }else{
            $.post('../Register/regEmailPost.html',{mobile:a.val()},function(data){
                if(data.status=='no'){
                    a.parents('li').css({"border-color": "#f04042"});
                    a.parents('label').siblings('.suc_msg').hide();
                    a.parents('label').siblings('.error_msg').show().children('p').html("号码已被注册");
                    return false;
                }else{
                    SucTip(a);
                    hideTip(a);
                }
            });
        }

    }else if(types == "email"){
	     if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
			a.parents('li').css("border-color","#f04042");
			a.parents('label').siblings('.suc_msg').hide();
			a.parents('label').siblings('.error_msg').show().children('p').html("邮箱格式不正确");
			return false;
        }else{
			$.post('../Register/regEmailPost.html',{email:a.val()},function(data){
				if(data.status=='no'){
					a.parents('li').css({"border-color": "#f04042"});
					a.parents('label').siblings('.suc_msg').hide();
					a.parents('label').siblings('.error_msg').show().children('p').html("邮箱已被注册");
					return false;
				}else{
					SucTip(a);
					hideTip(a);
				}
			});
		}
    }
}


/*  检查手机、座机号码*/
function checkALLPhone(a){
    var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
    var isMob = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
    if( isPhone.test(a.val()) == false && isMob.test(a.val())==false){
        a.parents('li').css("border-color","#f04042");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("号码不正确");
        return false;
    }else{
        SucTip(a);
        hideTip(a);
    }
}


/*  检查邮箱 */
function checkEmail(a) {
    if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
        a.parents('li').css("border-color","#f04042");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("邮箱格式不正确");
        return false;
    }else{
        SucTip(a);
        hideTip(a);
    }
}


/*  检查电话号码 */
function checkPhone(a) {
    if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
        a.parents('li').css({"border-color": "#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("电话号码不正确");
        return false;
    }else{
        SucTip(a);
        hideTip(a);
    }
}

/*  检查QQ */
function checkQQ(a){
    var pattern = /[1-9]([0-9]{5,11})/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color": "#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("QQ号码不正确");
        return false;
    }
}


/*  检查是否为数字 */
function checkNum(a) {
    var pattern = /^([0-9]+)$/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color": "#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("输入数字格式不正确");
    }
}


/*  检查密码格式 */
function checkPwd(a) {
    if (/^[a-zA-Z0-9_]{0,}$/.test(a.val()) == false) {
        a.parents('li').css({"border-color": "#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("密码只能由英文，数字组成");
        return false;
    } else {
        hideTip(a);
        if (a.val().length < 6 || a.val().length > 20) {
            a.parents('li').css({"border-color": "#f04042"});
            a.parents('label').siblings('.suc_msg').hide();
            a.parents('label').siblings('.error_msg').show().children('p').html("请输入6-20位密码");
            return false;
        } else {
            SucTip(a);
            hideTip(a);
        }
    }
}


/*  检查密码两次是否一样 */
function checkPwdTure(a) {
    var PWD1 = $('.tab li .pwd1').val();
    var PWD2 = a.val();
    if (PWD1 == "" || PWD1 == " ") {
        checkNull($('.tab li .pwd1'));
        a.parents('li').css({"border-color": "#f04042"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("两次密码不一致");
        return false;
    } else {
        hideTip(a);
        if (PWD1 != PWD2) {
            a.parents('li').css({"border-color": "#f04042"});
            a.parents('label').siblings('.suc_msg').hide();
            a.parents('label').siblings('.error_msg').show().children('p').html("两次密码不一致");
            return false;
        } else {
            SucTip(a);
            hideTip(a);
        }
    }
}


/*  判断验证码 */
function checkCode(a) {
	if(checkNull(a)!=false){
		var code = $(".code").val();
        var codeL = $(".code").val().length;
        if(codeL >= 4){
            $.post(uurl, {code: code}, function (data) {
                if (data == '2') {
                    a.parents('li').css("border-color","#f04042");
                    a.parents('label').siblings('.suc_msg').hide();
                    a.parents('label').siblings('.error_msg').show().children('p').html("验证码错误");
                    return false;
                }else{
                    SucTip(a);
                    hideTip(a);
                }
            });
        }else{
            a.parents('li').css("border-color","#f04042");
            a.parents('label').siblings('.suc_msg').hide();
            a.parents('label').siblings('.error_msg').show().children('p').html("验证码错误");
            return false;
        }

	}
}


/*  整体检测有无错误 */
function checkError(a) {
    if(a.next().is(".agrees")){
        if (a.siblings(".agrees").children(".agree").is(":checked")) {
            a.siblings(".agrees").children('.error_msg').hide();
        } else {
            a.siblings(".agrees").children('.error_msg').show().children('p').html("请同意相关条例");
            return false;
        }
    }

    var result = "no";
	var count = 0;
	a.children("li").each(function(){
	    $(this).find("input").trigger("blur");
	    if(++count===a.children("li").length){
		  if(a.find(".error_msg").is(":visible")){
			   return result = "no";
			   return false;
		  }else{
			   return result = "ok";
		  }
        }
    });
	return result;
}


/*   发送验证信息  */
function SendMsg(data){
   $.get('../Register/check_code.html', data , function (data) {
        if (data == "1") {
                $('.step1').hide();
                $('.step2').show();
                $('.process_line').css('width', "30%");
                $('.register_process ul li').eq(1).addClass('now');
                hideTip($(this));
            } else{
                $(".goStep2").attr("disabled","false");
                $(".goStep2").children('a').css({"opacity":"1","filter":"alpha(opacity=100)"});
                $(".goStep2").children(".wait").hide();
                alert("信息发送失败，请稍后再试");
				return false;
            }
    });
}


//发送验证码倒计时
function send() {
	var time = 30;
	function timeCountDown() {
		if (time == 0) {
			clearInterval(timer);
			$('.sendAgian a').addClass('canSend').removeClass('waitSend').html("重新发送");
			return true;
		} else {
			$('.sendAgian a').addClass('waitSend').removeClass('canSend').html(time + "s 后可再次发送");
			time--;
			return false;
		}
	}
	timeCountDown();
	var timer = setInterval(timeCountDown, 1000);
}



/*   提交表单  */
function m_post(a){
	var b={};
	a.each(function(i){
		var name=$(this).attr('name');
		var value=$(this).val();
		if(name&&value){
			b[name]=value;
		}
	});
	return b;
}






$(document).ready(function () {


    $(document).on("focus",'.tab_box li input', function () {
        hideTip($(this));
    });


    //用户名判断
    $('.tab_box #username').on("blur", function () {
        if(checkNull($(this)) != false) {
            check_name($(this));
        }
    });

    /*  登录密码判断 */
    $('.tab_box #pwd').on("blur", function () {
        if (checkNull($(this))!=false) {
            checkPwd($(this));
            checkPwdTure($('.tab_box #pwd1'));
        }
    });


    /*  确认密码判断 */
    $('.tab_box #pwd1').on("blur", function () {
        if(checkNull($(this))!=false){
            checkPwdTure($(this));
        }
    });
	
    /*  用户名判断 */
    $('.tab_box .username').on("blur", function () {
        if(checkNull($(this))!=false){
            check_name($(this));
        }
    });


    /*  电话号码判断 */
    $('.tab_box .tel').on("blur", function () {
        if(checkNull($(this))!=false){
            checkAllPhone($(this));
        }
    });
	
	
    /*  验证码判断 */
    $(document).on("blur",'.code', function () {
        if(checkNull($(this))!=false) {
            checkCode($(this));
        }
    });
	
	 /*  手机端验证码判断 */
    $(document).on("blur",'.phonecode', function () {
        if($(this).val()>=4){
            checkCode($(this));
        }
    });
	
	 /*  邮箱端验证码判断 */
    $(document).on("blur",'.emialcode', function () {
        if($(this).val()>=4){
            checkCode($(this));
        }
    });


    //点击同意条例
    $(document).on("click",'.agree', function () {
        if ($(this).is(":checked")) {
            $(this).siblings('.error_msg').hide();
        }
    });


    /*  邮箱地址判断 */
    $(document).on("blur",'.tab .email_text',function(){
        if(checkNull($(this))!=false){
            check_name($(this));
        };
    });


    //手机号码判断
    $(document).on("blur",'.phone_text', function () {
        if(checkNull($(this))!=false){
            check_name($(this));
        }
    });


    //审核信息  公司信息展开关闭
    $(document).on("click",'.OpenBtn', function () {
        $(this).hide();
        $('.company_info').show();
    });
    $(document).on("click",'.CloseBtn', function () {
        $('.OpenBtn').show();
        $('.company_info').hide();
    });


    //到第二步
    $(document).on("click",'.goStep2',function () {
        if(checkError($(this).siblings('.tab'))=="ok"){
		  var type=$('.step1 ul').attr('name');
		  var mobile = $('.phone_text').val();
		  var email = $('.email_text').val();
		  $(".goStep2").attr("disabled","true");
          $(".goStep2").children('a').css({"opacity":"0","filter":"alpha(opacity=0)"});
          $(".goStep2").children(".wait").show();
		  if(type=='mobile'){
			  var data= {mobile: mobile,type:type}
		  }else if(type=='email'){
			  var data= {email: email,type:type}
		  }
		  SendMsg(data);						
		}
    });

        //到第一步
        $('.goback').bind("click", function () {
            $('.step2').hide();
            $('.step1').show();
            $('.step1').children('ul').children('li').children('input').val("");
            $('.step1').children('ul').children('li').children('span').show();
            $('.process_line').css('width',"10%");
            $('.register_process ul li').eq(1).removeClass('now');
            hideTip($(this));
        });

        //到第三步
        $('.goStep3').bind("click", function () {
            if(checkError($(this).siblings('.tab'))=="ok"){
				var phonecode=$('.phonecode').val();
				var emialcode=$('.emialcode').val();
				var sta=1;
				var type=$('.step2 ul').attr('name');
				if(type=='mobile'){
					var data= {code:phonecode,sta:sta,type:type}
				}else if(type=='email'){
					var data= {code:emialcode,sta:sta,type:type}
				}
				
				$.get('../Register/check_code.html',data,function(data){
					if(data=="1") {
								$('.step2').hide();
								$('.step3').show();
								$('.process_line').css('width',"50%");
								$('.register_process ul li').eq(2).addClass('now');
								hideTip($(this));
					}else {
						$('.step2 li').css("border-color", "#f00");
						$('.step2 .suc_msg').hide();
						$('.step2 .error_msg').show().children('p').html("验证码错误");
						return false;
					}
				});					
            }
        });


        //第三步提交信息
        $('.sub_now').on("click", function () {
            if(checkError($(this).siblings('.tab'))=="ok"){
					var type=$('.step4 ul').attr('name');
					var username=$('.username').val();
					var password=$('.password').val();
					if(type=='mobile'){
						var data= {username:username,password:password,type:type}
					}else if(type=='email'){
						var data= {username:username,password:password,type:type}
					}else{
						var data= {username:username,password:password,type:type}
					}
					$.get('../Register/phone.html',data,function(data){
						if(data.status=='ok') {
							self.location = 'check_infos.html';
						}else if(data.status=='false'){
							//alert(data.info);
							return false;
						}
					});					
				}
        });




        $('.sendAgian a').on("click", function () {
            if ($(this).hasClass('canSend')) {
                send();
                var type=$('.step1 ul').attr('name');
                var mobile = $('.phone_text').val();
                var email = $('.email_text').val();
                if(type=='mobile'){
                    var data= {mobile: mobile,type:type}
                }else if(type=='email'){
                    var data= {email: email,type:type}
                }
                SendMsg(data);
            } else {
                return false;
            }
        });




});











