/**
 * Created by john on 2016/11/2.
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
/*  检查是否有内容 */
function checkSelect(a){
    if(a.val()==0&&a.val()!=''){
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
        a.children("form").children('li').each(function(){
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


    /*   编码  */
    for(var i=0;i<26;i++){
        //alert(String.fromCharCode(65+i));//输出A-Z  26个大写字母
        $('<option name='+String.fromCharCode(65+i)+'>'+String.fromCharCode(65+i)+'</option>').appendTo($('#bianhao'));
    }
	
	
	
	
	
	
	
$(document).ready(function(){	
	
	 /*   不能为空的 */
    $(document).on("keyup",'.tab .words input[type="text"]',function(){
        checkTxt($(this));
    });
    $(document).on("blur",'#bianhao',function(){
        checkTxt($(this));
    });
    $(document).on("blur",'#shuimoshi',function(){
        checkSelect($(this));
    });
    $(document).on("blur",'.tab .words input[type="text"]',function(){
        $(this).trigger("keyup");
    });
	
	
    /*  电话判断 */
    $(document).on("keyup",'.phoneMob input[type="text"]',function(){
        if(checkNull($(this))!=false){
            checkALLPhone($(this));
        };
    });
    $(document).on("blur",'.phoneMob input[type="text"]',function(){
        $(this).trigger("keyup");
    });	
	
	
    /*  邮编 */
    $(document).on("keyup",'.tab .youbian',function(){
        if(checkNull($(this))!=false){
            checkNum($(this));
        };
    });
    $(document).on("blur",'.tab .youbian',function(){
        $(this).trigger("keyup");
    });	
	
    /*  网站 */
    $(document).on("keyup",'.tab .url',function(){
        if(checkNull($(this))!=false){
            checkWeb($(this));
        };
    });
    $(document).on("blur",'.tab .url',function(){
        $(this).trigger("keyup");
    });		
	
	/*  是否为数字 */
    $(document).on("keyup",'.num input[type="text"]',function(){
        if(checkNull($(this))!=false){
            checkNum($(this));
        };
    });
    $(document).on("blur",'.num input[type="text"]',function(){
        $(this).trigger("keyup");
    });	
	
	
	
	
	$(document).on('click', ".common_adds", function () {
        checkTxt($('#bianhao'));
        checkSelect($('#shuimoshi'));
		if(checkError($(this).parents(".btns").siblings(".tab"))=="ok"){
		     add_form();
		}
    });


    //
    // /*  添加企业信息  */
    // $(".add").on("click",function() {
    //     if(checkError($(this).parents('.btns').siblings(".tab"))!=false){
    //             var qiyeid=$(".qiyeid").attr('name');
    //             var result = {};
    //             $("ul").find("input").each(function() {
    //                 var name = $(this).attr("name");
    //                 var value = $(this).val();
    //                 if(name&&value){
    //                     result[name] =  value;
    //                 }
    //             });
    //             var url="../Person/companypost.html";
    //             if(qiyeid!='undefined'){
    //                     $.ajax({
    //                         type: "POST",
    //                         url : url,
    //                         data: {data : JSON.stringify(result),bianhao:bianhao,qiyeid:qiyeid,shuimoshi:shuimoshi}, //注意这里的写法
    //                         success: function(msg){
    //                             if (msg.status == 'ok') {
    //                                 alert("修改成功");
    //                                 window.location.reload();
    //                             }else
    //                             {
    //                                 $(".addreses ul .suc_msg").hide();
    //                                 $('.check_info_box p').html("修改失败，请稍后重试");
    //                                 //layer.msg(msg.info, {icon: 2});
    //                             }
    //                         }
    //                     });
    //             }else {
    //                     $.ajax({
    //                         type: "POST",
    //                         url: url,
    //                         data: {data: JSON.stringify(result), bianhao: bianhao, shuimoshi:shuimoshi}, //注意这里的写法
    //                         success: function (msg) {
    //                             if (msg.status == 'ok') {
    //                                 alert("添加成功");
    //                                 window.location.reload();
    //                             } else {
    //                                 $(".addreses ul .suc_msg").hide();
    //                                 $('.check_info_box p').html("添加失败，请稍后重试");
    //                                 //layer.msg(msg.info, {icon: 2});
    //                             }
    //                         }
    //                     });
    //             }
    //     }
    // });





        //删除收货地址
    $('.addreses ul li .del_addr').live("click",function(){
        var url="../Person/delqiyeadd.html";
        var id=$(this).attr('name');
        if(confirm("确定删除此条信息？")){
            $.post(url,{id:id},function(data){
                if(data.status=='ok') {
                    alert("删除成功");
                    window.location.reload();
                } else{
                    $(".addreses ul .suc_msg").hide();
                    $('.check_info_box p').html("删除失败，请稍后重试");
                   // layer.msg(data.info,{icon:2});
                }
            });
        }
    });

});



