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
};


/*  正确提示  */
function SucTip(a) {
    hideTip(a);
    a.parents('label').siblings(".suc_msg").show();
}


/*  检查是否为空 */
function checkNull(a) {
    if (a.val() == "" || a.val() == " ") {
        a.parents('li').css("border-color","red");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("不能为空");
        return false;
    }
};

/*  检查是否有内容 */
function checkTxt(a){
    if(a.val()=="" || a.val()==" "){
        a.parents('li').css("border-color","red");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("不能为空");
        return false;
    }else{
        hideTip(a);
        SucTip(a);
    }
};


/*  检查网址*/
function checkWeb(a){
    var pattern = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color":"red"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("网站地址不正确");
    }
};


//判断是否被注册
function check_name(a){
    var types = a.attr("name");
    if(types == "username"){
		if(/^[a-zA-z0-9\u4E00-\u9FA5]+$/.test(a.val()) == false) {
			a.parents('li').css({"border-color": "red"});			
			a.parents('label').siblings('.suc_msg').hide();
			a.parents('label').siblings('.error_msg').show().children('p').html("用户名不能含有特殊字符");
			return false;
		} else {
			var len = a.val().replace(/[^\x00-\xff]/g, "**").length;
			if (len < 4 || len > 10) {
				a.parents('li').css({"border-color": "red"});
				a.parents('label').siblings('.suc_msg').hide();
				a.parents('label').siblings('.error_msg').show().children('p').html("用户名在4至10位字符");
				return false;
			} else {
			    SucTip(a);
				hideTip(a);

			}
		}

    }else if(types == "mobile"){
         if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
            a.parents('li').css({"border-color": "red"});
            a.parents('label').siblings('.suc_msg').hide();
            a.parents('label').siblings('.error_msg').show().children('p').html("电话号码不正确");
            return false;
        }else{
            $.post('../Register/regEmailPost.html',{mobile:a.val()},function(data){
                if(data.status=='no'){
                    a.parents('li').css({"border-color": "red"});
                    a.parents('label').siblings('.suc_msg').hide();
                    a.parents('label').siblings('.error_msg').show().children('p').html("该号码已被注册");
                    return false;
                }else{
                    SucTip(a);
                    hideTip(a);
                }
            });
        }
    }else if(types == "email"){
	   if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
        a.parents('li').css("border-color","red");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("邮箱格式不正确");
        return false;
       }else{
          $.post('../Register/regEmailPost.html',{email:a.val()},function(data){
            if(data.status=='no'){
                a.parents('li').css({"border-color": "red"});
                a.parents('label').siblings('.suc_msg').hide();
                a.parents('label').siblings('.error_msg').show().children('p').html("该邮箱已被注册");
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
        a.parents('li').css("border-color","red");
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("号码不正确");
        return false;
    }else{
        SucTip(a);
        hideTip(a);
    }
};


/*  检查电话号码 */
function checkPhone(a) {
    if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
        a.parents('li').css({"border-color": "red"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("电话号码不正确");
        return false;
    }else{
        SucTip(a);
        hideTip(a);
    }
};

/*  检查QQ */
function checkQQ(a){
    var pattern = /[1-9]([0-9]{5,11})/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color": "red"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("QQ号码不正确");
        return false;
    }
};


/*  检查是否为数字 */
function checkNum(a) {
    var pattern = /^([0-9]+)$/;
    if (pattern.test(a.val())) {
        SucTip(a);
        hideTip(a);
    } else {
        a.parents('li').css({"border-color": "red"});
        a.parents('label').siblings('.suc_msg').hide();
        a.parents('label').siblings('.error_msg').show().children('p').html("输入数字格式不正确");
    }
};



/*  判断验证码 */
function checkCode(a) {
	if(checkNull(a)!=false){
		var code = $(".code").val();
		$.post(uurl, {code: code}, function (data) {
			if (data == '2') {
				a.parents('li').css("border-color","red");
				a.parents('label').siblings('.suc_msg').hide();
				a.parents('label').siblings('.error_msg').show().children('p').html("验证码错误");
				return false;
			}else{
				SucTip(a);
				hideTip(a);
			}
		});		
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
	    $(this).children("label").children("input").trigger("blur");
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
    //暂时隐藏错误信息
	
    $("input").placeholder();
		 
		 
    $(document).on("focus",'.tab_box li input', function () {
        hideTip($(this));
    });


/*  ==========================必填部分=============================  */

    /*  验证码判断 */
    $(document).on("keyup",'.code', function () {
	    checkCode($(this));
    });
    $(document).on("blur",'.code', function () {
        $(this).trigger("keyup");
    });


    /*  邮箱地址判断 */
    $(document).on("keyup",'.tab .Semail',function(){
        if(checkNull($(this))!=false){
            check_name($(this));
        };
    });
    $(document).on("blur",'.tab .Semail',function(){
        $(this).trigger("keyup");
    });
	
	 /*  电话判断 */
    $(document).on("keyup",'.tab .phone_text',function(){
        if(checkNull($(this))!=false){
            check_name($(this));
        };
    });
    $(document).on("blur",'.tab .phone_text',function(){
        $(this).trigger("keyup");
    });
	
	/*  电话判断(收货人必填手机号) */
    $(document).on("keyup",'.tab .phone_text2',function(){
        if(checkNull($(this))!=false){
            checkPhone($(this));
        };
    });
    $(document).on("blur",'.tab .phone_text2',function(){
        $(this).trigger("keyup");
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

    /*   不能为空的 */
    $(document).on("keyup",'.tab .words input',function(){
        checkTxt($(this));
    });
    $(document).on("blur",'.tab .words input',function(){
        $(this).trigger("keyup");
    });

    /*  QQ */
   $(document).on("keyup",'.tab .QQ',function(){
        if(checkNull($(this))!=false){
            checkQQ($(this));
        };
    });
    $(document).on("blur",'.tab .QQ',function(){
        $(this).trigger("keyup");
    });
	
	
	
/*  ==========================非必填部分=============================  */

   /*  联系电话 */
    $(document).on("keyup",'.tab .tel',function(){
		if($(this).val()!=""){
			checkALLPhone($(this));
		}else{
		    hideTip($(this));
		}   
    });
    $(document).on("blur",'.tab .tel',function(){
        $(this).trigger("keyup");
    });
	

    /*  检测网站 */
    $(document).on("keyup",'.tab .danweiwangzhi',function(){
	    if($(this).val()!=""){
			checkWeb($(this));
		}else{
		    hideTip($(this));
		}  
    });
    $(document).on("blur",'.tab .danweiwangzhi',function(){
        $(this).trigger("keyup");
    });


    $('.sendInfo').live("click", function () {
        if(checkError($(this).siblings('.tab'))=="ok"){
            var a=m_post($('.b'));
            var b=m_post($('.c'));
            var c=m_post($('.d'));
            var code=$('.code').val();
            var url="../Register/infospost.html";
            $.post(url,{aa:a,bb:b, cc:c,code:code},function(data){
                if(data.sta=='ok'){
                    location.href="../Register/register_wait.html"
                }else if(data.sta=='code'){
                    return false;
                }else{
                    alert("提交失败，请稍后重试");  //添加失败
                }

            });
        }
    });



});











