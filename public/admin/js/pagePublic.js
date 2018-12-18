/**
 * Created by john on 2016/12/29.
 */
function hideLoading(){
   // $(window.top.document).find(".loadingWeb").hide(); //隐藏加载
}
function showLoading(){
  //  $(window.top.document).find(".loadPage").not(":hidden").children(".loadingWeb").show();//显示加载
}

/* 复制 */
function get_copy() {
    var btns = document.querySelectorAll('a');
    var clipboard = new Clipboard(btns);
    clipboard.on('success', function(e) {
        alert("复制成功");
    });
    clipboard.on('error', function(e) {
        alert("复制失败");
    });
}

/* 检查有没有lookType */
function checkLookType(){
    var lookTypeLength = $(".lookType").length;
    if(lookTypeLength > 0){
        $(".PageBox").find("form").removeClass();
    }else{
        $(".PageBox").find("form").addClass("noLookType");
    }
}

/* lookType宽度 */
function lookTypeWidth(){
    var lookType = $(".radiusBtn");
    var ulWidth = 0;
    for(var i = 0; i < lookType.length; i ++){
        var liArr = lookType.eq(i).find("li");
        for(var j = 0 ; j < liArr.length; j ++){
            ulWidth += Math.ceil(liArr.eq(j).width() + 21); // margin-left:20px;
        }
        lookType.eq(i).css("width",ulWidth + "px");
        ulWidth = 0;
    }
}


/*  选择性表格  */
function chooseDl(){
    $(".partBox .chooseDl").after("<div class='chooseDlBtn radius blue'>显示筛选条件</div>");
}

/* li里面的全选 */
function checkBox() {
    var CheckedLength = $(".checkBoxBox").length;
    var hasChecked = $(".checkBoxBox:checked").length;
    if(CheckedLength == hasChecked){
        $(".checkBoxAll").prop("checked","true");
    }else{
        $(".checkBoxAll").prop("checked",false);
    }
}
/*  仿table 添加列表展开按钮 */
function tableDetail(){
    $(".mainTable .tableName").prepend("<i class='tableDetailBtn tableOpenBtn'></i>");
}

/*  table 添加列表展开按钮 */
function tableInfoDetail(){
    $(".listTable tr").each(function(){
        $(this).find(".tableName").prepend("<i class='tableDetailBtn tableOpenBtn' title='展开详情'></i>");
    });

}


function levelBtn(){
    $(".level dt").prepend("<em class='levelBtns'>…</em>")
}

function sets(){
    var windowW = $(document).width();
    var windowH = $(window).height();
    if(windowW<900){
       // $(".PageBox").css("height",windowH - 50);
        $(".changeWebBox").css("height",windowH - 50);
    }else{
       // $(".PageBox").css("height",windowH);
        $(".changeWebBox").css("height",windowH);
    }

}

function checkNullPoint(){
    $(".checkNull").parents("li").find(".liLeft").prepend("<span class='redWord'>✱ </span>");
}



$(document).ready(function(){
    var windowW = $(document).width();

    sets();
    checkNullPoint();
    tableInfoDetail();
    checkLookType();
    if(windowW<=900){
      //  tableDetail();
        lookTypeWidth();
        chooseDl();
        levelBtn()
    }else{
        sets();

    }

    $(window).resize(function(){
        sets();
    });

    /*  仿table展开详情  */
    $(document).on("click",".mainTable .tableOpenBtn",function(){
        $(this).addClass("tableCloseBtn").removeClass("tableOpenBtn");
        var obj = $(this).parents(".tdModel").append("<div class='detailTable'></div>");
        var thNum = 0;
        var trNum = 0;
        $(this).parents(".tdModel").siblings(".tdModel:not('.tableDel')").each(function(){
            $(this).attr("num",trNum);
            $(this).parents(".trModel").find(".detailTable").append("<div class='trModel' name='"+trNum+"'></div>");
            $(this).parents(".trModel").find(".detailTable").find(".trModel[name='"+trNum+"']").append($(this).clone());
            trNum +=1;
        });
        $(this).parents(".mainTable").find(".thModel:not('.tableDel')").each(function(){
            $(this).attr("num",thNum);
            obj.find(".detailTable").find(".trModel[name='"+thNum+"']").prepend($(this).clone());
            thNum +=1;
        });
    });

    /*  仿table 关闭详情 */
    $(document).on("click",".mainTable .tableCloseBtn",function(){
        $(this).addClass("tableOpenBtn").removeClass("tableCloseBtn");
        $(this).siblings(".detailTable").remove();
    });



    /*  展开详情  */
    $(document).on("click",".listTable .tableOpenBtn",function(){
        var tdLength = $(this).parents("tr").find("td").length;
        var thNum = 0;
        var trNum = 0;
        $(this).parents(".listTable").find(".detailTableTr").remove();
        $(this).parents("tr").addClass("showTr").siblings("tr").removeClass("showTr");
        $(this).parents(".listTable").find(".tableCloseBtn").removeClass("tableCloseBtn").addClass("tableOpenBtn");
        $(this).addClass("tableCloseBtn").removeClass("tableOpenBtn").attr("title","收起详情");
        $(this).parents(".listTable").find(".showTr").after("<tr class='detailTableTr'><td colspan='"+tdLength+"'><div class='detailTable'></div></td></tr>");
        $(this).parents("td").siblings("td:not('.tableInfoDel')").each(function(){
            $(this).attr("num",trNum);
            $(this).parents(".listTable").find(".detailTable").append("<div class='detaileLine' name='"+trNum+"'><div class='detailName' ></div><div class='detailContent'></div></div>");
            $(this).parents(".listTable").find(".detailTable").find(".detaileLine[name='"+trNum+"']").children(".detailContent").append($(this).html());
            trNum +=1;
        });
        $(this).parents(".listTable").find("th:not('.tableInfoDel')").each(function(){
            $(this).attr("num",thNum);
            $(".detailTable").find(".detaileLine[name='"+thNum+"']").children(".detailName").prepend($(this).html());
            thNum +=1;
        });
    });

    /*  关闭详情 */
    $(document).on("click",".listTable .tableCloseBtn",function(){
        $(this).addClass("tableOpenBtn").removeClass("tableCloseBtn").attr("title","展开详情");
        $(this).parents("tr").removeClass(".showTr").siblings(".detailTableTr").remove();
    });


    /* 手机端按钮  */
    $(document).on("click",".PageBtn .phoneBtnOpen",function(){
       if($(this).hasClass("opend")){
           $(this).removeClass("opend").siblings(".phoneBtns").hide();
       }else{
           $(this).addClass("opend").siblings(".phoneBtns").show();
       }
    });

    $(document).on("click",".level .levelBtns",function(){
        var obj = $(this).siblings(".buttons");
        if(obj.is(":visible")){
            obj.hide();
        }else{
            obj.show();
        }
    });

    $(document).on("click",".chooseDlBtn",function(){
        var obj = $(this).siblings(".chooseDl");
        if(obj.is(":visible")){
            obj.hide();
            $(this).text("显示筛选条件");
        }else{
            $(this).text("隐藏筛选条件");
            obj.show();
        }
    });

    $(document).on("click",".lookType a",function(){
        var url = $(this).attr("href");
        $(window.frameElement).attr("src",url);
    });
    
    
    /*   判断是否有说明   */
    var shuoming = $(".shuoming").text();
    if(shuoming!=""){
        $('.LTjilu').show();
    }else{
        $('.LTjilu').hide();
    }

    /* 列表隐藏部分  */
    $(document).on("click",".hideBox_showBtn span",function(){
        $(this).parents(".hideBox_Btn").siblings(".hideBox").show();
        $(this).parents(".hideBox_Btn").removeClass("hideBox_showBtn").addClass("hideBox_hideBtn");
        $('.zywUl .listTable tbody tr:hidden').show();
    });
    $(document).on("click",".hideBox_hideBtn span",function(){
        $(this).parents(".hideBox_Btn").siblings(".hideBox").hide();
        $(this).parents(".hideBox_Btn").removeClass("hideBox_hideBtn").addClass("hideBox_showBtn");
        $('.zywUl .listTable tbody tr:nth-child(n+4)').hide();
    });

    /*   刷新页签  */
    $(document).on("click",".Refresh",function(){
        var links = $(window.frameElement).attr("src");
       // var name = $(window.frameElement).attr("name");
        $(window.frameElement).attr("src",links);
        var Topiframe = $(window.top.document);
        //$(window.top.document).find(".loadPage").not(":hidden").children(".loadingWeb").show();
        // $($(window.frameElement)).on("load",function(){
        //    // Topiframe.find(".loadPage").not(":hidden").children(".loadingWeb").hide();
        // });
    });

    /*  各系统主页统计连接 */
    $(document).on("click",".index_links a",function(){
        var sys = $(this).attr("sys");
        var url = $(this).attr("url");
        parent.$($(window.parent.document).find("#head ul li[sys='"+sys+"'] a"),parent.document).trigger("click");
        parent.$($(window.parent.document).find("#C_left dl[sys='"+sys+"'] ."+url+""),parent.document).trigger("click");
    });

    /*   载入层  */       ////////////////////变换当前页
    $(document).on("click",".changeWeb",function(){
        var PageUrl = $(this).attr("data_url");
        var PageHeight = $(this).parents("body").height()-4;
        if(windowW < 900){
            // $(this).parents(".nowWebBox").hide();
            window.location.href=PageUrl
        }else{
            $(".nowWebBox").hide();
            var newFrame = $("body").append("<div class='changeWebBox' style='height:"+PageHeight+"px;'><iframe frameborder='no' src='"+PageUrl+"'></iframe></div>");

        }

    });

    /*  载入层 关闭按钮  */       ////////////////////变换当前页
    $(document).on("click",".changeWebClose",function(){
         // var links = $(window.parent.frameElement).attr("src");
         // parent.location.href = links;
          parent.location.reload();
        // var links = $(window.parent.frameElement).attr("src");
        // var Topiframe = $(window.top.document);
       // $(window.parent.frameElement).siblings(".loadingWeb").show();
       //  $(window.parent.frameElement).attr("src",links+parameter);
        // $($(window.parent.frameElement)).on("load",function(){
        //    // Topiframe.find(".loadPage").not(":hidden").children(".loadingWeb").hide();
        // });
    });

    /*  翻页改变父级iframe 的src  */
    $(document).on("click",".page-link",function(){
        var newUrl = $(this).attr("href");
        var Topiframe = $(window.top.document);
        //$(window.frameElement).siblings(".loadingWeb").show();
        $(window.frameElement).attr("src",newUrl);
        // $($(window.frameElement)).on("load",function(){
        //   //  Topiframe.find(".loadPage").not(":hidden").children(".loadingWeb").hide();
        // });


    });



    /*   弹出层  */       ////////////////////弹出对话框
    $(document).on("click",".alertWeb",function(){
        var PageUrl = $(this).attr("data_url");
        var blackHeight = $(document).height();
        $(".nowWebBox").append("<h1></h1>");
        if(windowW < 900){
          // $(this).parents(".nowWebBox").hide();
            window.location.href=PageUrl
        }else{
            $("body").append("<div id='smallBlack' class='showBlack'></div><div class='alertWebBox'><iframe frameborder='no' data_name='alertIframe' src='"+PageUrl+"'></iframe></div>");

            $(document).find("iframe[data_name='alertIframe']").on("load",function(){
                $(this).contents().find(".PageBtn").addClass("alertPageBtn");
                $(this).contents().find(".PageBox").addClass("alertPageBox");
                $(this).contents().find(".changeWebClose").removeClass("changeWebClose").addClass("alertWebClose");
            });
            console.log("上一个高度是 ： " + blackHeight)
            $("#smallBlack").css("height",blackHeight + "px");
        }

    });

    /*  弹出层 关闭按钮  */       ////////////////////弹出对话框
    $(document).on("click",".alertWebClose",function(){
        var links = $(window.parent.frameElement).attr("src");
        var Topiframe = $(window.top.document);
        //$(window.parent.frameElement).siblings(".loadingWeb").show();
        $(window.parent.frameElement).attr("src",links);
        $($(window.parent.frameElement)).on("load",function(){
           // Topiframe.find(".loadPage").not(":hidden").children(".loadingWeb").hide();
        });
    });



    // /*   点击关闭编辑框  */
    // $(document).on("click",".AlertClose",function(){
    //     var PageName = $(this).attr("name");
    //     $("#alertBox").hide().siblings("div").show();
    //     $("#alertBox ."+PageName+"").hide();
    // });

    /*  订单页面  显示/隐藏二维码  */
    $(document).on("click",".codeBox .OpenCode",function(){
         $(this).siblings("#qrcode").show();
         $(this).siblings(".CloseCode").show();
         $(this).hide();
    });
    $(document).on("click",".codeBox .CloseCode",function(){
        $(this).siblings("#qrcode").hide();
        $(this).siblings(".OpenCode").show();
        $(this).hide();
    });

    /*  选项卡选择 */
    $(document).on("click",".PageBox .PageLinks li",function(){
        $(this).addClass("active").siblings("li").removeClass("active");
        var index = $(this).index();
        $(this).parents(".PageLinks").siblings(".Pages").children(".Page").eq(index).addClass("active").siblings(".Page").removeClass("active");
    });



    /*  table里的全选 */
    $(document).on("click",".SelectAll",function(){
        if($(this).is(":checked")){
            $(this).parents(".listTable").find(".selectBox").prop("checked",true);
        }else{
            $(this).parents(".listTable").find(".selectBox").prop("checked",false);
        }
    });
    $(document).on("click","table .selectBox",function(){
        var TD = $(this).parents("table").children('tbody').children("tr").children("td");
        var CheckedLength = TD.find(".selectBox").length;
        var hasChecked = TD.find(".selectBox:checked").length;
        if(CheckedLength == hasChecked){
            $(this).parents("tr").siblings("tr").children("th").children(".SelectAll").prop("checked","true");
        }else{
            $(this).parents("tr").siblings("tr").children("th").children(".SelectAll").prop("checked",false);
        }
    });

    /*li里的全选*/
    $(document).on("click",".checkBoxAll",function(){
        if($(this).is(":checked")){
            $(this).parent(".liLeft").siblings('.liRight').find(".checkBox").prop("checked",true);
        }else{
            $(this).parent(".liLeft").siblings('.liRight').find(".checkBox").prop("checked",false);
        }
    });
    $(document).on("click",".selectBox",function(){
        checkBox();
    });


    /* table 内部select修改 操作里统一确定取消*/
    $(document).on("click",".changeBtn",function(){
        $(this).hide().siblings("button").hide().siblings(".ChanConfirm").show();
        $(this).parent(".tdModel").siblings(".tdModel").children(".old").hide();
        $(this).parent(".tdModel").siblings(".tdModel").children(".changeBox").show();
        $(this).parents(".trColspan").find("input[type='text']:disabled").removeAttr("disabled");
        $(this).parents(".trModel").find("input[type='text']:disabled").removeAttr("disabled");
    });
    $(document).on("click",".ChanConfirm",function(){
        $(this).hide().siblings(".ChanConfirm").hide();
        $(this).parent(".tdModel").siblings(".tdModel").children(".changeBox").hide();
        $(this).parent(".tdModel").siblings(".tdModel").children(".old").show();
        $(this).siblings("button").show().siblings(".ChanConfirm").hide();
        $(this).parents(".trModel").find("input[type='text']").attr("disabled",true);
        $(this).parents(".trColspan").find("input[type='text']").attr("disabled",true);
    });


	
    /*  弹出层载入窗 关闭按钮   带提醒功能  */
    $(document).on("click",".AlertInfoCloseConfirm",function(){
		var AlertInfo = $(this).attr("info");
        var status = $(this).attr("name");
        var type = $(this).attr("type");
        var oid = $(this).data("id");
        var links = $(window.parent.frameElement).attr("src");
		if(confirm(AlertInfo)){
            add_form(status,type);
			// var AlertBox = $(this).attr("name");
			// $(this).parents("html"). empty();
			// $(window.parent.document).find("#alertBox").hide().siblings("div").show();
			// $(window.parent.document).find("#alertBox ."+AlertBox+"").hide();
			// parent.location.reload();
	    }else{
            $.get(out_url,{"orderid":oid,"admin":0},function (data) {
                if(data.sta=='ok'){
                    $(window.parent.frameElement).attr("src",links);
                }else{
                    $(window.parent.frameElement).attr("src",links);
                }
            });
            return false;
		}

    });
     /**copy**/
    $(document).on('click', '.editCanshu .copy', function () {
        var index = $(this).parent('.canshuBtn').siblings('dl').find('input').length;
        var afterDd=$(this).parent('.canshuBtn').siblings('dl').find('dd:last');
        if (index <= 4) {
            afterDd.after(afterDd.clone())
            $(this).parent('.canshuBtn').siblings('dl').find('dd:last') .find('input').val('')
        }
        if (index == 4) {
            $(this).parent('.canshuBtn').hide();
        }
    });
    $(document).on('click', '.editCanshu .delThis', function () {
        var index = $(this).parent('dd').siblings().find('input').length;
        if (index >0 && index < 5) {
            $(this).parents('dl').siblings('.canshuBtn').show()
            $(this).parent('dd').remove();
        }
    });
    /**copy**/

});