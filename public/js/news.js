/**
 * Created by john on 2016/7/8.
 */
$(document).ready(function(){
    /*  新闻热点资讯显示图标  */
    $(".hotNews ul li").eq(0).addClass("active");
    $(".hotNews ul li").on("mouseenter",function(){
        $(this).addClass("active").siblings('li').removeClass();
    });

    /*  精选触摸变暗  */
    $(".goodNews ul li").on("mouseenter",function(){
        $(this).children('a').children('span').css("opacity","0.6");
    });
    $(".goodNews ul li").on("mouseleave",function(){
        $(this).children('a').children('span').css("opacity","0.4");
    });

    $("a").attr('data-ajax',false);
    /*  添加锚点 */
    var PicLength = $('.main_pic a').length -1;
    var NowIndex = $('.main_point ul .active').index();

    /*  点击锚点 */
    $("#banner .main_point li").on("click",function(){
        var PushIndex = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $('.main_pic a').eq(PushIndex).addClass("active").siblings("a").removeClass("active");
    });


    $(".GoRight").on("click",function(){
        if(NowIndex >= PicLength){
            NowIndex = 0;
        }else{
            NowIndex += 1 ;
        }
        $(".main_point ul li").eq(NowIndex).trigger("click");
    });

    $(".GoLeft").on("click",function(){
        if(NowIndex <= 0){
            NowIndex = PicLength;
        }else{
            NowIndex -= 1;
        }
        $(".main_point ul li").eq(NowIndex).trigger("click");
    });



    /*  定时器  */
    var  autoMove;
    function Move(){
        $(".GoRight").trigger("click");
    }
    $('#banner .main_point ul li').on("click",function(){
        clearInterval(autoMove);
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










});
