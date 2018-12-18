/**
 * Created by john on 2016/12/29.
 */

$(document).ready(function(){

   /*   默认设置  */
    $("#C_left dl[sys!='web']").hide();
    $("#C_body .loadPage[sys!='web']").hide();
    $("#C_page .fixIndex[sys!='web']").hide();
    $("#C_foot .footPage[sys!='web']").hide();
    var WindowW = $(window).width();
    function changeWind(){
        docuHeight = $(window).height();
        docuWidth = $(window).width();
        pageWidth = $('#C_page').width();
        $('#content').height(docuHeight);
        if(WindowW <=900){
            $('#content #C_body').height(docuHeight-45);
            $("#content #C_page .pageControl").css("width","100%");   // 选项卡总宽度
            $("#content #C_page .pageBox").css("width",pageWidth-62);   // 选项卡页签宽度
        }else{
            var linksHeight = docuHeight - 256;
            $('#content #C_body').height(docuHeight-43);
            $("#content #C_page .pageControl").css("width",pageWidth);   // 选项卡总宽度
            $("#content #C_page .pageBox").css("width",pageWidth-62);   // 选项卡页签宽度
        }
        $(".LeftLinks").css({"height":linksHeight,"overflow-x":"auto"});            //左侧菜单高度
    }
    $(window).resize(function(){
        changeWind();
    });
    changeWind();

    /*  检测选项卡是否超出 */
    function checkPage(){
        var PageWidth = $('#C_page .pageBox').width();
        var sum = 0;
        $('#C_page .pageBox ul:visible li').each(function(){
             sum += ($(this).width()+1);
        });
        if(sum >= PageWidth){
            var Left = PageWidth - sum;
            $("#C_page .pageLeft").addClass("canMove canLeftGo");
            $("#C_page .pageRight").addClass("canMove canRightGo");
            $("#C_page .pageBox ul:visible").stop().animate({left:""+Left+"px"},500);
        }else{
            $("#C_page .pageLeft").removeClass("canMove canLeftGo");
            $("#C_page .pageRight").removeClass("canMove canRightGo");
        }
    }

    /*  检测选项卡是否超出 -----   切换系统 */
    function SyscheckPage(){
        var PageWidth = $('#C_page .pageBox').width();
        var sum = 0;
        $('#C_page .pageBox ul:visible li').each(function(){
            sum += ($(this).width()+1);
        });
        if(sum >= PageWidth){
            $("#C_page .pageLeft").addClass("canMove canLeftGo");
            $("#C_page .pageRight").addClass("canMove canRightGo");
        }else{
            $("#C_page .pageLeft").removeClass("canMove canLeftGo");
            $("#C_page .pageRight").removeClass("canMove canRightGo");
        }
    }

	/*  显示/隐藏      收起/展示左部链接  */
	$(document).on("mouseover","#C_left",function(){
		$("#C_left .LeftShou").fadeIn(100);
	});	
	$(document).on("mouseleave","#C_left",function(){
		$("#C_left .LeftShou").fadeOut(100);
	});
	
	/*  收起/展示左部链接  */
	$(document).on("click","#C_left .LeftShou",function(){
		$(this).removeClass("LeftShou").addClass("LeftZhan");
		$(this).parents("#C_left").css({"width":"0"});
		$("#C_right").css({"width":"100%"});
	});
	$(document).on("click","#C_left .LeftZhan",function(){
		$(this).removeClass("LeftZhan").addClass("LeftShou");
		$(this).parents("#C_left").css({"width":"13%"});
		$("#C_right").css({"width":"87%"});
	});	

    /*   向左移动标签  */
    $(document).on("click","#C_page .canLeftGo",function(){
        $("#C_page .pageBox ul:visible").stop().animate({left:"0px"},500);
    });

    /*   向右移动标签  */
    $(document).on("click","#C_page .canRightGo",function(){
        var PageWidth = $('#C_page .pageBox').width();
        var sum = 0;
        $('#C_page .pageBox ul:visible li').each(function(){
            sum += ($(this).width()+1);
        });
        var Left = sum-PageWidth;
        $("#C_page .pageBox ul:visible").stop().animate({left:"-"+Left+"px"},500);
    });

    /*  切换系统  */
   $(document).on("click","#C_left .sys_links li",function(){
       var sys = $(this).attr("sys");
       $(this).addClass("active").siblings("li").removeClass("active");
       $("#C_left dl[sys='"+sys+"']").show();
       $("#C_left dl[sys!='"+sys+"']").hide();
       $("#C_page .pageBox li[sys='"+sys+"']").show();
       $("#C_page .pageBox li[sys!='"+sys+"']").hide();
       $("#C_page .pageBox ul[name='"+sys+"']").show().css("left","0").siblings("ul").hide();
       $("#C_page .pageBox ul[name='"+sys+"'] li").eq(0).children("a").trigger("click");
       $("#C_body .loadPage").hide();
       $("#C_body .loadPage[sys='"+sys+"']").eq(0).show();
       $("#C_foot .footPage[sys='"+sys+"']").show();
       $("#C_foot .footPage[sys!='"+sys+"']").hide();
       SyscheckPage();
   });


    // /*  弹窗 —————— 确认 */
    // function alertModel(a,b){
    //     var picUrl;
    //     if(b=="red"){
    //         picUrl = "./Public/system/pic/alertRed.png";
    //     }else if(b=="blue"){
    //         picUrl = "./Public/system/pic/alertBlue.png";
    //     }else if(b=="green"){
    //         picUrl = "./Public/system/pic/alertGreen.png";
    //     }
    //     $(window.top.document).find(".alertModel").addClass("alertModelShow");
    //     $(window.top.document).find(".bigBlack").addClass("bigBlackShow");
    //     $(window.top.document).find(".alertModelShow").children(".alertPic").attr("src",picUrl);
    //     $(window.top.document).find(".alertModelShow").children(".alertModelMsg").html("<p>"+a+"</p>");
    // }
    //
    // $(document).on("click",".myPic",function(){
    //     // 第二个参数为信息图标 red为叉  blue为叹号   green为勾
    //     var msg;
    //     var type;
    //     msg = "这里是内润光";
    //     type = "green";
    //     alertModel(msg,type);
    // });
    //
    //
    // /*  信息弹窗关闭  */
    // $(document).on("click",".alertBtn",function(){
    //     $(this).parents(".alertModel").removeClass("alertModelShow");
    //     $(this).parents(".alertModel").siblings(".bigBlack").removeClass("bigBlackShow");
    // });


    function checkLoading(e){
        var iframeModel = $("iframe[name='"+e+"']");
        $(iframeModel).on("load",function(){
            //setTimeout(function(){$("#"+e+"").find(".loadingWeb").hide();},800);
        });
    }

   /*  左部点击载入页面  */
  $(document).on("click","#C_left dl dd a",function(){
      $(this).off("click");
      var sys = $(this).attr("sys");
      var pageName = $(this).attr("name");
      var pageLinks = $(this).attr("pagelink");
      var pageCN = $(this).text();

      $(this).parents("dd").addClass('active').siblings().removeClass("active");
      $(this).parents("dd").parents("dl").addClass("haveActive").siblings("dl").removeClass("haveActive").find("dd").removeClass();
      if($("#C_page ul[name='"+sys+"'] li").hasClass(pageName)){
          $("#C_page ul[name='"+sys+"'] ."+pageName+" a").trigger("click");
      }else{
          $("#C_right #C_body").append("<div class='loadPage' id='"+pageName+"' sys='"+sys+"'><iframe frameborder='no' name='"+pageName+"' src='"+pageLinks+"'></iframe></div>");
          $("#C_page ul[name='"+sys+"'] div").before("<li class='active MovePage "+pageName+"' name='"+pageName+"' sys='"+sys+"'><a>"+pageCN+"</a><i></i></li>");
          $("#C_page ul[name='"+sys+"'] li:not(."+pageName+")").removeClass("active");
          $("#C_body .loadPage:not(#"+pageName+")").hide();
          checkLoading(pageName)
          checkPage();
          // $.ajax({
          //     type:"POST",
          //     url:pageLinks,
          //     data: "",
          //     success:function(msg){
          //         $("#C_right #C_body").append("<div class='loadPage' id='"+pageName+"' sys='"+sys+"'><div class='loadingWeb'><span class='loadingPic'></span></div><iframe frameborder='no' name='"+pageName+"' src='"+pageLinks+"'></iframe></div>");
          //         $("#C_page ul[name='"+sys+"'] div").before("<li class='active MovePage "+pageName+"' name='"+pageName+"' sys='"+sys+"'><a>"+pageCN+"</a><i></i></li>");
          //         $("#C_page ul[name='"+sys+"'] li:not(."+pageName+")").removeClass("active");
          //         $("#C_body .loadPage:not(#"+pageName+")").hide();
          //         checkLoading(pageName)
          //         checkPage();
          //     },
          //     error:function(XMLHttpRequest, textStatus, thrownError){}
          // });

      }
  });


    /*  个人资料 点击连接  */
    $(document).on("click","#head .myName .links",function(){
         var pageName =$(this).attr("name");
         var sys =$(this).attr("sys");
         $("#head .sys_links li[sys='"+sys+"']").trigger("click");
         $("#C_left dl ."+pageName+"").trigger("click");
    });


    /*   选项卡点击事件  */
    $(document).on("click","#C_page ul li a",function(){
        var sys = $(this).parent("li").attr("sys");
        var NowPage = $(this).parent("li").attr("name");
        $(this).parent("li").addClass("active").siblings("li").removeClass("active");
        $("#C_body #"+NowPage+"[sys='"+sys+"']").show().siblings('.loadPage').hide();
        $("#C_left dl[sys='"+sys+"'] ."+NowPage+"").parent("dd").addClass("active").siblings("dd").removeClass("active");
        $("#C_left dl[sys='"+sys+"'] ."+NowPage+"").parents('dl').addClass("showMenu haveActive").siblings("dl").removeClass("showMenu haveActive").find("dd").removeClass();
    });

    /*  关闭选项卡 */
    $(document).on("click","#C_page ul li i",function(){
        var sys = $(this).parent("li").attr("sys");
        var PageName = $(this).parent("li").attr("name");
        if($(this).parents("li").hasClass("active")){
            $(this).parents('li').prev("li").children("a").trigger("click");
        }
        $("#C_body  #"+PageName+"").remove();
        $(this).parents('li').remove();
        $("#C_left dl[sys='"+sys+"'] #"+PageName+"").parent("dd").removeClass("active");
        $("#C_left dl[sys='"+sys+"']").removeClass("haveActive");
        checkPage();
    });





    // /*   订单消息关闭  */
    // $(document).on("click","#head .orderAlert",function() {
    //     var MyLinks = $(this).children(".infoBox");
    //     if(MyLinks.is(":visible")){
    //         $(this).css("background","#106381").children("span").stop().rotate({animateTo:0});
    //         $(".my .infoBox").hide();
    //     }else{
    //         $(this).css("background","#0F4D63").children("span").stop().rotate({animateTo: 180});
    //         $(".my .infoBox").show();
    //     }
    // });
    // /*   订单消息连接  */
    // $(document).on("click",".orderAlert .infoBox b",function(){
    //     var NowPage = $(this).attr("data-id");
    //     var Nowsys = $("#head ul .active").attr("sys");
    //     var Forsys = $(this).attr("sys");
    //     if(Forsys == Nowsys){
    //         $("#C_left dl[sys='"+Forsys+"'] dd ."+NowPage+"").trigger("click");
    //     }else{
    //         $("#head ul li[sys='"+Forsys+"'] a").trigger("click");
    //         $("#C_left dl[sys='"+Forsys+"'] dd ."+NowPage+"").trigger("click");
    //     }
    // });

   /*   顶部个人  */
    $(document).on("click","#C_left .myName .titB",function() {
        var MyLinks = $(this).siblings(".myControl");
        if(MyLinks.is(":visible")){
            MyLinks.hide();
            $(this).children(".infoIcon").stop().rotate({animateTo:0});
        }else{
            MyLinks.show();
            $(this).children(".infoIcon").stop().rotate({animateTo:180});
        }
    });

    /*   左部连接  */
    $(document).on("click","#C_left dl dt",function(){
        var linksHide = $(this).parents("dl");
        if(linksHide.hasClass("showMenu")){
            linksHide.removeClass("showMenu");
        }else{
            linksHide.addClass("showMenu").siblings("dl").removeClass("showMenu");
        }
    });

   /*  回到主页  */
   $(document).on("click",".phoneIndex",function(){
       $(".pageBox").find("ul[style*='display: block']").children(".fixIndex").children("a").trigger("click");
   });








});