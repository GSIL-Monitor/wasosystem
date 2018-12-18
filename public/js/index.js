/**
 * Created by john on 2016/7/8.
 */

 function newAutoMove(){
	     var num = 4;  // 列数
        for(var i = 0; i < 6; i++){
           $('.news .newAutoBox').append($('.news .newAutoBox dd').eq(i).clone());
        }
        var boxTop = parseInt($('.news .newAutoBox').position().top);
        var boxHeight = $('.news .newAutoBox').height();
        var lineHeight = parseInt(boxHeight / num);
        var maxTop =  parseInt(boxHeight / num * (num-1));
        var move = function(){
            console.log(lineHeight)
            if(boxTop >= maxTop){
                $(".news .newAutoBox").css({"top":'0'});
                boxTop = 0;
            }
            boxTop += lineHeight;
            $(".news .newAutoBox").animate({"top":-boxTop},300);
        };
        var timer = setInterval(move,3000);
        $(".news .newAutoBox").mouseover(function(){
            clearInterval(timer);
        });
        $(".news .newAutoBox").mouseleave(function(){
            timer = setInterval(move,3000);
        });
 }
 

$(document).ready(function(){
    var bodyWidth = $(window).width();
    $("#p_header").hide();
    $("a").attr('data-ajax',false);



if(bodyWidth<900){
    $(".bottomPng").attr("src","../Public/index/Pic/index/Pbottom.png");
	
	
}


    /*  底部广告  */
    function showBotAD(){
        $("#botAD").css("bottom","-105px");
    }
    if(bodyWidth>900){
       newAutoMove();
    }
    $(document).on("mouseover","#botAD",function(){
        $("#botAD").css("bottom","0");
    });
    $(document).on("mouseleave","#botAD",function(){
        $("#botAD").css("bottom","-105px");
    });
    $(document).on("click","#botAD .closeBotAD",function(){
        $("#botAD").hide();
    });


    /*  添加锚点 */
    $.fn.getHexBackgroundColor = function() {
        var rgb = $(this).css('background-color');
        if(!$.browser.msie){
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            function hex(x) {
                return ("0" + parseInt(x).toString(16)).slice(-2);
            }
            rgb= "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }
        return rgb;
    };

    /*   banner初始设置  */
    function changeWind(){
        var bannerW = $(window).width();
        var BigBannerHight = $(window).height()*0.8;
        if(BigBannerHight>680){
            BigBannerHight=680;
        }
        if(bannerW<900){
            $(".main_pic").css("height",BigBannerHight*0.9);
            $(".main_pic .bannerPage").css("height",BigBannerHight*0.9);
            $(".main_pic .bannerPage span").css("padding-top",Math.round(BigBannerHight*0.07));
        }else{
            $(".main_pic").css("height",BigBannerHight);
            $(".main_pic .bannerPage").css("height",BigBannerHight);
        }


        $("#banner .main_pic .bannerPage").eq(0).addClass("active");
        /* 手机端变换banner图片连接  */
        $("#banner .main_pic .bannerPage").each(function(){
            var bgcolor= $(this).attr("data-color");
            var float= $(this).children('.moveBox').children('span').attr("data-float");
            var ppic=$(this).attr("data-ppic");
            var mpic=$(this).attr("data-mpic");
            if(bannerW <900){
                var links =mpic;
                $('#banner .main_pic .bannerPage').not(".active").children("span").css({flter: "Alpha(Opacity=0)", "bottom": "0", "opacity": "0"});
            }else{
                var links = ppic;
                $(this).children('.moveBox').children('span').children('em').css({"text-align":float});
                $('#banner .main_pic .bannerPage').not(".active").children("span").css({flter: "Alpha(Opacity=0)", "bottom": BigBannerHight/2-100, "opacity": "1"});
            }
            $(this).css({"background-image":"url("+links+")","width":"100%",'background-color':"rgb("+bgcolor+")"});
        });
    }
    changeWind();
    $(window).resize(function(){
        changeWind();
    });



    /*  点击锚点 */
    $("#banner .main_point li").on("click",function(){
        var PushIndex = $(this).index();
        var PointColor = $(this).attr("data-color");
        if(PointColor=="W" ){
            $(this).parents("ul").removeClass().addClass("whitePoint");
        }else if(PointColor=="B" || PointColor=="LOGO" ){
            $(this).parents("ul").removeClass().addClass("blackPoint");
        }

        $(".main_pic .bannerPage").eq(PushIndex).addClass("active").siblings().removeClass("active");
        $(this).addClass("active").siblings().removeClass("active");
    });


   /*  定时器  */
   var  autoMove;
   function Move(){
       var index = $("#banner .main_point .active").attr("data-number");
       var bannerLength = $("#banner .main_point li").length - 1;
       if(index < bannerLength){
           $("#banner .main_point ul .active").next("li").trigger("click");
       }else{
           $("#banner .main_point ul li").eq(0).trigger("click");
       }
   }
   $('#banner .main_point ul li').on("click",function(){
       clearInterval(autoMove);
      autoMove = window.setInterval(Move,5000);
   });
    $('#banner .main_pic div a').on("mouseover",function(){
        clearInterval(autoMove);
    });
    $('#banner .main_pic div a').on("mouseout",function(){
        autoMove = window.setInterval(Move,5000);
    });
    autoMove = setInterval(Move,5000);


    $(document).on("swipe","#banner",function(e){
        e.stopImmediatePropagation();
    });
    var isMove = false;
    $('#banner').bind('touchstart',function(e){
        e.stopImmediatePropagation();
        isMove = true;
        startX = e.originalEvent.changedTouches[0].pageX;
        startY = e.originalEvent.changedTouches[0].pageY;
    });

    $('#banner').on('touchmove',function(e){
        e.stopImmediatePropagation();
        if (isMove){
            //获取滑动屏幕时的X,Y
            endX = e.originalEvent.changedTouches[0].pageX;
            endY = e.originalEvent.changedTouches[0].pageY;
            //获取滑动距离
            distanceX = endX-startX;
            distanceY = endY-startY;
            //判断滑动方向
            if(distanceX>0 && Math.abs(distanceY)<5){
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    window.event.returnValue == false;
                }
                var index = $("#banner .main_point .active").attr("data-number");
                if(index>=1){
                    $("#banner .main_point .active").prev().trigger("click");
                }else{
                    $("#banner .main_point li").eq(4).trigger("click");
                }
                clearInterval(autoMove);
                autoMove = window.setInterval(Move,5000);
                return isMove = false;
                $("#banner").unbind("touchmove");
            }else if(distanceX<=0 && Math.abs(distanceY)<5){
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    window.event.returnValue == false;
                }
                var index = $("#banner .main_point .active").attr("data-number");
                if(index<4){
                    $("#banner .main_point .active").next().trigger("click");
                }else{
                    $("#banner .main_point li").eq(0).trigger("click");
                }
                clearInterval(autoMove);
                autoMove = window.setInterval(Move,5000);
                return isMove = false;
                $("#banner").unbind("touchmove");
            }
        }
    });




    /*   顶部菜单  */
    $(document).on("click",".P_menu_btn",function(){
        if($(".P_menu").is(":visible")){
            $(this).removeClass("P_menu_btnActive");
            $(".P_menu").css("overflow-y","hidden").slideUp();
        }else{
            var MenuH = $(window).height()+20;
            $(".P_menu").css({"height":MenuH});
            $(this).addClass("P_menu_btnActive");
            $(".P_menu").css("overflow-y","scroll").slideDown();
        }

     });

    $(document).on("click",".P_menu li",function(){
        var Dl = $(this).next("dl");
        if(Dl.is(":visible")){
            $(this).removeClass("activeLi");
            Dl.slideUp();
        }else{
            $(this).addClass("activeLi").siblings("li").removeClass();
            Dl.slideDown().siblings("dl").slideUp();
        }
    });

    $(document).on("click",".P_menu dl dt",function(){
        var Dd = $(this).next("dd");
        if(Dd.is(":visible")){
            $(this).removeClass("activeDt");
            Dd.slideUp();
        }else{
            $(this).addClass("activeDt").siblings("dt").removeClass();
            Dd.slideDown().siblings("dd").slideUp();
        }
    });








});







