/**
 * Created by john on 2016/11/1.
 */



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
	
	
	/*  检查网址*/
	function checkWeb(a){
		var pattern = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
		if (pattern.test(a.val())) {
			SucTip(a);
			hideTip(a);
		} else {
            a.css("border-color","red");
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("网站地址不正确");
		}
	};
	
	/*  检查手机、座机号码*/
	function checkALLPhone(a){
		var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
		var isMob = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
		if( isPhone.test(a.val()) == false && isMob.test(a.val())==false){
            a.css("border-color","red");
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("号码不正确");
			return false;
		}else{
			SucTip(a);
			hideTip(a);
		}
	};


	/*  检查邮箱 */
	function checkEmail(a) {
		if (/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.val()) == false) {
			a.css("border-color","red");
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("邮箱格式不正确");
			return false;
		}else{
			SucTip(a);
			hideTip(a);
		}
	};

	
	/*  检查电话号码 */
	function checkPhone(a) {
		if (/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/.test(a.val()) == false) {
			a.css({"border-color": "red"});
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("电话号码不正确");
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
			a.css({"border-color": "red"});
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("QQ号码不正确");
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
			a.css({"border-color": "red"});
			a.siblings('.suc_msg').hide();
			a.siblings('.error_msg').show().children('p').html("输入数字格式不正确");
		}
	};


    /*  整体检测有无错误 */
    function checkError(a){
        var count = 0;
		var result = "no";
        a.children('li').each(function(){
            $(this).children(".info_in").children("input[type='text']").trigger("blur");
			if(++count===a.find("li").length){
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



    /*   编码序号选择  */
    for(var i=0;i<26;i++){
        $('<option name='+String.fromCharCode(65+i)+'>'+String.fromCharCode(65+i)+'</option>').appendTo($('#bianhao'));
    }




$(document).ready(function(){
	
	 /*   不能为空的 */
    $(document).on("keyup",'.tab .words input[type="text"]',function(){
        checkTxt($(this));
    });
	$(document).on("blur",'.tab .words select',function(){
		checkTxt($(this));
	});
    $(document).on("blur",'.tab .words input[type="text"]',function(){
        $(this).trigger("keyup");
    });	
	
    $(document).on("keyup",'.phoneMob input[type="text"]',function(){
        if(checkNull($(this))!=false){
            checkALLPhone($(this));
        };
    });
    $(document).on("blur",'.phoneMob input[type="text"]',function(){
        $(this).trigger("keyup");
    });	
	
	$(document).on('click', ".common_adds", function () {
		checkTxt($('#bianhao'))
		if(checkError($(this).parents(".btns").siblings(".tab"))=="ok"){
		     add_form();
		}
    });		
	

    /*  提交修改 */
/*    $(".change_sub").on("click",function(){
        if(checkError($(this).parents('.btns').siblings(".tab"))=="ok"){
                var wlid=$(".wlid").attr('name');
                var address=$("input[name='address']").val();
                var bianhao=$("select[name='bianhao']").val();
                var bytel= $("input[name='bytel']").val();
                var tel=$("input[name='tel']").val();
                var shouhuoren=$("input[name='shouhuoren']").val();
                var wlzhiding=$("input[name='zhiding']").val();
                var url="../Person/addrespost.html";
                if(wlid!=''){
                    $.post(url,
                            {wlid:wlid,address:address,bianhao:bianhao,bytel:bytel,tel:tel,shouhuoren:shouhuoren,wlzhiding:wlzhiding},
                            function(data){
                                if (data.status == 'ok') {
                                    alert("修改成功");
                                    window.location.reload();
                                }else
                                {
                                    $(".addreses ul .suc_msg").hide();
                                    $('.check_info_box p').html("修改失败，请稍后重试");
                                   // layer.msg(data.info, {icon: 2});
                                }
                            });
                }else{
                        $.post(url,
                            {address:address,bianhao:bianhao,bytel:bytel,tel:tel,shouhuoren:shouhuoren,wlzhiding:wlzhiding},
                            function(data){
                                if (data.status == 'ok') {
                                    alert("添加成功");
                                    window.location.reload();
                                }else
                                {
                                    $(".addreses ul .suc_msg").hide();
                                    $('.check_info_box p').html("添加失败，请稍后重试");
                                   // layer.msg(data.info, {icon: 2});
                                }
                            });
                }
        }
    });*/




});