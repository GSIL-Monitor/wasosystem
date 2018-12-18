/**
 * Created by john on 2016/7/8.
 */
//二维码
function qrcode() {
    $('#peizhi').html('')
    var qrcode = $('.codes').val();
    var options = {
       render: "canvas",
        color: "#000000",
        text: qrcode,
        size: parseInt(100, 10)
    };
    $('#peizhi').qrcode(options);
}
function clipboard() {
    var clipboard = new ClipboardJS(".copyInfoBtn");
    clipboard.on( "success" ,function(e){
        sysAlert("复制成功")
        e.clearSelection();
    });
    clipboard.on("error" , function(e) {
        sysAlert("系统版本太低，请手动复制代码")
    });
}

/* 弹出编辑征集框 */
function editMachine(){
    var scrollBox = Math.ceil($(".pro_detail .zyw_material_editor ul").height())  + 50;
    var editInfoHeight = $(".pro_detail .editInfo").height();
    var alertBoxHeight = scrollBox + editInfoHeight;
    var MaxHeight = Math.ceil($(window).height() * 0.8);
    console.log("maxheight : " + MaxHeight);
    $(".pro_detail").css({"height": MaxHeight , "top":"10%" , "margin-top" : 0});
    $(".editBox .listTable").css({"height": MaxHeight + "px" });
    MaxHeight -= 217
    $(".pro_detail .listTable .detail_inner").css({"height": MaxHeight + "px" });
    $(".pro_detail .editBoxWrap .zyw_material_editor").css({"padding-top": editInfoHeight});
}


/* 编辑框点击修改弹出定位  */
function alertEdit(div){
    var Y = div.position().top;
    var X = div.offset().left;
    $(".detail_inner .ivu-select-dropdown").css({"bottom": Y +"px" , "left" : X + "px"});
    console.log("X: " + X + " - y: " + Y );
}



$(window).resize(function(){
    editMachine();
});

$(document).ready(function(){
	var windowW = $(document).width();
    qrcode();
    clipboard();
	/*  点击展开服务模式 */
	$(document).on("click",".p_serverBox .arrow" ,function(){
         if($("#Pic_black").is(":visible")){
            $(".serverBox").css("bottom","-100%");
            $("#Pic_black").hide();
        }else{
            $(".serverBox").css("bottom","0");
            $("#Pic_black").show();
        }
	});

	
    /*  选择服务模式  */
	$(document).on("click",".serverBox .chosL",function(){
		$(this).addClass("activeLabel").siblings("label").removeClass("activeLabel");
        $('.serverBox .chosL').children('input').removeAttr('checked');
        $(this).children('input').attr('checked',true);
		$(".p_serverBox .content").text($(this).text());
		$(".serverBox").css("bottom","-100%");
        service();
        AllPriceTotal();
		$("#Pic_black").hide();
	});
    /*  选择票据模式  */
	$(document).on("click",".other_box .chosL",function(){
		$(this).addClass("activeLabel").siblings("label").removeClass("activeLabel");
        $('.other_box  .chosL').children('input').removeAttr('checked');
        $(this).children('input').attr('checked',true);
		var invoice_type = $(this).children('input').val();
		if(invoice_type== 'no_invoice'){
			$(".p_piaoBox .content").text($(this).text());
		    $(".other_box").css("bottom","-100%");
	    	$(".hide_box").hide();
		}else{
            $(".hide_box").show();
        }
        AllPriceTotal();
	});	
	




    /*  购物车 手机端编辑  */
    $('.orderTable .menu button').toggle(function(){
        $(this).text("完成");
        $('.orderList .num').show();
    },function(){
        $(this).text("编辑");
        $('.orderList .num').hide();
    });
	
	/*  显示/隐藏二维码  */
	$(document).on("click",".pro_list .checkL",function(){
		if($(this).children(".daima").is(":visible")){
			$(this).children(".daima").hide();
		}else{
		    $(this).children(".daima").show();
		}
	});	
	
	/*  展示下载excel详情   意向*/
	$(document).on("click",".orderList .openDetail",function(){
		if(windowW<900){
			 if($("#Pic_black").is(":visible")){
				$(".detailTable").css("bottom","-100%");
			    $("#Pic_black").hide();
			}else{
				$(".detailTable").css("bottom","0");
			    $("#Pic_black").show();			
			}
		}else{
		    if($(this).parents(".orderList").siblings(".detailTable").is(":visible")){
			     $(this).parents(".orderList").siblings(".detailTable").hide();
		     	 $(".proDetail").html("展开配置<i></i>");
		   }else{
		        $(this).parents(".orderList").siblings(".detailTable").show();
		        $(".proDetail").html("收起配置<i class='close'></i>");
		   }		
		}
	});
	$(document).on("click",".proDetail",function(){
	    $(this).siblings(".orderList").find(".openDetail").eq(0).trigger("click");
	});

    /*  展示下载excel详情   非意向*/
    $(document).on("click",".afterTable .openDetail",function(){
		if(windowW<900){
			if($("#Pic_black").is(":visible")){
				$(".detailTable").css("bottom","-100%");
			    $("#Pic_black").hide();
			}else{
				$(".detailTable").css("bottom","0");
			    $("#Pic_black").show();			
			}
		}else{
			 if($(this).parents(".afterTable").siblings(".detailTable").is(":visible")){
				$(this).parents(".afterTable").siblings(".detailTable").hide();
				$(".proDetail").html("展开配置<i></i>");
			}else{
				$(this).parents(".afterTable").siblings(".detailTable").show();
				$(".proDetail").html("收起配置<i class='close'></i>");
			}
		}
    });
    $(document).on("click",".proDetail",function(){
        $(this).siblings(".afterTable").find(".openDetail").eq(0).trigger("click");
    });


    $('.safe .add_pass').bind("click",function(){
          $('.add_box').show();
    });
    $('.add_box .send').bind("click",function(){
        $('.add_box .pass_step').show();
        $('.add_box .pass_tip').show();
    });



	
	/* 打开编辑意向订单 */
    $(".editDetail").on("click",function(){
        editMachine();
        $(".pro_detail").addClass("showProDetail");
        $("#Pic_black").css("z-index",1001).fadeIn(300);
        // A_checkNum();
        // A_proPriceTotal();
    });
    $(document).on("click",".edit_Cancel",function(){
        $(".pro_detail").removeClass("showProDetail");
        $("#Pic_black").css("z-index",0).fadeOut(300);
    });
    $(document).on("click","#Pic_black",function(){
        $(".pro_detail").removeClass("showProDetail");
        $("#Pic_black").css("z-index",0).fadeOut(300);
    });


	
    /*   选择收货地址  */
	$(document).on("click",".MoreBtn",function(){
		if($("#Pic_black").is(":visible")){
           	$(".addrMore").css("bottom","-100%");
			$("#Pic_black").hide();
		}else{
			$("#Pic_black").show();
			$(".addrMore").css("bottom","0");
		} 
	});
	$(document).on("click",".addrBox li",function(){
           	$(".addrMore").css("bottom","-100%");
			$("#Pic_black").hide();
	});
	$(document).on("click","#Pic_black",function(){
           	$(".addrMore").css("bottom","-100%");
			$(".detailTable").css("bottom","-100%");
			$(".serverBox").css("bottom","-100%");
			$(".other_box").css("bottom","-100%");
			$("#Pic_black").hide();
	});
	
	
	
    /*   新增收货地址  */	
	$(document).on("click",".NewBtn",function(){
        var Width = $(window).width();
        var Height = $(window).height();
		var editHeight = $(".addrEdit").height();
		var DivTop = (Height-editHeight-80) / 2 + "px";
        if(Width<900){
            $(".addrEdit").css({left:"0"});
            $(".addrEdit").stop().animate({bottom:0},300);
        }else{
			$(".addrEdit").css({left:"50%","margin-left":"-420px"});
            $(".addrEdit").stop().animate({bottom:""+DivTop+""},300);
        }
        $("#Pic_black").css("z-index",9991).fadeIn(300);
	});
	$(document).on("click",".addrEdit .button a",function(){
        $("#Pic_black").fadeOut(300);
        $(".addrEdit").stop().animate({bottom:"-100%"},300);  
	});
	$(document).on("click",".addrEdit .closeBtn",function(){
        $("#Pic_black").fadeOut(300);
        $(".addrEdit").stop().animate({bottom:"-100%"},300);  
	});	



	/*   选择开票地址  */	
	$(document).on("click",".MoreTicksBtn",function(){
		if($(this).parents(".ticksBtns").siblings(".addrMore").is(":visible")){
            $(this).parents(".ticksBtns").siblings(".ticksAddr").show();
		    $(this).html("更多单位<i></i>");
	        $(this).parents(".ticksBtns").siblings(".addrMore").slideUp(300);
		}else{
		    $(this).html("收起单位<i class='closeMore'></i>");
            $(this).parents(".ticksBtns").siblings(".ticksAddr").hide();
	        $(this).parents(".ticksBtns").siblings(".addrMore").slideDown(300);
		} 
	});
	$(document).on("click",".ticksBox li",function(){
		if(windowW<900){
			$(".p_piaoBox .content").text($(this).text());
		    $(".other_box").css("bottom","-100%");
	    	$("#Pic_black").hide();
		}else{
		    $(this).parents(".addrMore").siblings(".ticksAddr").show();
	        $(this).parents(".addrMore").siblings(".ticksBtns").children(".MoreTicksBtn").html("更多单位<i></i>");
            $(this).parents(".addrMore").slideUp(300);
		}
	});	
	$(document).on("click",".p_piaoBox .arrow",function(){
		    $(".other_box").css("bottom","0");
	    	$("#Pic_black").show();
	});
	
    //删除信息
    $('.chooseBox li .deleteAddr').live("click",function(){
        var url="../Person/deladdress.html";
        var id=$(this).attr('name');
        if(confirm("确定删除此条信息？")){
            $.post(url,{id:id},function(data){
                if(data.status=='ok') {
                    alert("删除成功");
                    window.location.reload();
                } else{
                    $(".addreses ul .suc_msg").hide();
                    $('.check_info_box p').html("删除失败，请稍后重试");
                }
            });
        }
    });
	
    /*  设置默认地址   */
    $('.note').click(function(){
        var mid=$(this).data('id');
        var sid=$(this).data('action');
        $.post(set_url,{id:mid,sid:sid},function(data){
            if(data.status=='ok') {
                alert("设置成功");
                window.location.reload();
            } else{
                alert("信息读取失败，请稍后再试");
                window.location.reload();
            }
        });
    });
    //检查默认物流
    function checkDefaultLogistics() {
        $.each($('.chooseBox .logistics'),function () {
            if($(this).hasClass('active')){
                $('.logistics_id').val($(this).attr('data-id'));
                $('.CheckAddr').html($(this).children().clone());
            }
        })
    }
    //检查默认企业
    function checkDefaultCompany() {
        $.each($('.chooseBox .company'),function () {
            if($(this).hasClass('active')){
                $('.invoice_info').val($(this).attr('data-id'));
                $('.p_piaoBox .content').html($(this).children().text());
                $('.ticksAddr').html($(this).children().clone())
            }
        })
        var invoice_type=$('.other_box .chosL').children('input:checked').val();
        if(invoice_type == 'no_invoice' ){
            $('.hide_box').hide()
        }
    }
    checkDefaultLogistics();
    checkDefaultCompany();
   //点击选择收货地址
    $('.chooseBox .logistics').live("click",function(){
        $('.logistics_id').val($(this).attr('data-id'));
        $('.CheckAddr').html($(this).addClass("active").children().clone())
        $(this).addClass("active").siblings("li").removeClass('active');
    });
    $('.chooseBox .company').live("click",function(){
        $('.invoice_info').val($(this).attr('data-id'));
        $('.p_piaoBox .content').html($(this).children().text());
        $('.ticksAddr').html($(this).children().clone())
        $(this).addClass("active").siblings("li").removeClass('active');
    });


    /*   选择退货退款 详情  */
    $('.return_box .returnType').on("change",function(){
        var type = $(this).children('option:selected').attr("name");
        if(type=="returnAll"){
           $('.all_back').show()
           $(".Money_back").hide();
        }else if(type="returnMoney"){
            $('.all_back').hide()
            $(".Money_back").show();
        }
    });


    /*   订单详情 流程图  */
    function xiangqing_liucheng() {
        var hasDone = $(".Svalue").val();
        hasDone++;
        for(var i=0; i < hasDone; i++){
            $('.p_icon ul li').eq(i).addClass("active");
            $('.iconDetail li').eq(i).addClass("active");
        }
        var LineWidth = null;
        if(hasDone==1){
            $(".iconDetail h5 b").text("意向订单");
            LineWidth = "10%";
        }else if(hasDone==2){
            $(".iconDetail h5 b").text("下单订货");
            LineWidth = "30%";
        }else if(hasDone==3){
            $(".iconDetail h5 b").text("订单受理");
            LineWidth = "50%";
        }else if(hasDone==4){
            $(".iconDetail h5 b").text("在途运输");
            LineWidth = "70%";
        }else if(hasDone==5){
            $(".iconDetail h5 b").text("成交订单");
            LineWidth = "80%";
        }
        $('.p_liucheng_line').css("width",LineWidth);
    }
    xiangqing_liucheng();
    /*   订单详情 流程图  背景图   */



    /*   地址栏展开详情  */
    $(document).on("click",'.addreses .LikeBtn',function(){
        var Tb = $(this).parents("li");
        if(Tb.children("dl").is(":hidden")){
            Tb.children("dl").show();
            Tb.siblings("li").children("dl").hide();
        }else{
            Tb.children("dl").hide();
        }
    });

    /*   显示关闭 编辑弹窗 */
    $(document).on("click",".addreses button",function(){
		$(this).parents(".info").hide().siblings(".edit").show();
        $('.edit .nowBianhao').hide();
        $('.edit li b').show();
        $('.edit .title').text("添加信息");
    });
    $(document).on("click",".addreses .change_edit",function(){
        var id=$(this).data('id');
        $.get(edit_url,{'id':id},function (data) {
         if(data.sta=='ok'){
             $.each(data.data,function (i,n) {
                 $('.edit input[name="'+i+'"]').val(n);
                 $('.edit select[name="'+i+'"]').children('option[value="'+n+'"]').attr('selected','selected');
                 $('.edit select[name="'+i+'"]').css("border-color","#dedede");
                 $('.edit input[name="'+i+'"]').css("border-color","#dedede");
             });
             $('.edit .nowBianhao').show();
             $('.edit li b').hide();
             $('.edit .title').text("修改信息");
             $(".info").hide().siblings(".edit").show();
         }else{
             alert(data.info);
             return false;
         }
        });
    });
    $(document).on("click",".edit .close",function(){
        $('.edit .error_msg').hide("");
        $('.edit .suc_msg').hide("");
        $(this).parents(".edit").hide().siblings(".info").show();
        $('.edit input').val("");
    });


    /*   地址栏弹窗 提示内容  */
    $(".edit input").each(function(){
        $(this).focus(function(){
            var InputVal = $(this).val();
             if(InputVal=="" || InputVal==" "){
                 $(this).siblings("b").hide();
             }
        });
        $(this).blur(function(){
            var InputVal = $(this).val();
            if(InputVal=="" || InputVal==" "){
                $(this).siblings("b").show();
            }else{
                $(this).siblings("b").hide();
            }
        });
    });
	
	









});







