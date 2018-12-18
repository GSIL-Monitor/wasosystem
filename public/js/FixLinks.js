/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){


    /*  产品锚标记  固定  */
    var ScreenW = $(document).width();
    var navH2 = $(".fixLinks").offset().top;
    var PicTop = $(".buy_left").offset().top;
    var PicLeft = (ScreenW-1240)/2;
    var PicHeight = $(".buy_left").height();
    var PicMaxTop = $(".info_down").offset().top - PicHeight -70;

    //锚：
    $('.fixLinks ul li a').click(function() {
        var target = $(this).attr("name");
        var targetTop = $(".detail_box ."+target+"").offset().top-30;
        $("body,html").stop().animate({scrollTop:targetTop},500);
    });

    function linksChange(a){
        a.parents('li').addClass("active").siblings('li').removeClass("active");
    }

    $(window).scroll(function(){
        var targetTop = $(this).scrollTop();
        var scroH2 = $(document).scrollTop();
        /*  图片   */
        var detailTop = $(".detail_box .detail").offset().top-40;
        var newsTop = $(".detail_box .otherServer").offset().top-40;
        var downTop = $(".detail_box .serverDown").offset().top-40;
        var saleTop = $(".detail_box .sale_records").offset().top-40;

        if(ScreenW>900){
            if(targetTop>=PicTop && targetTop<=PicMaxTop){
                $('.buy_left').css({"position":"fixed","left":PicLeft,"top":0,"bottom":"auto",'width':"620"});
            }else if(targetTop>=PicMaxTop){
                $('.buy_left').css({"position":"absolute","left":0,"top":"auto","bottom":0});
            }else if(targetTop<PicTop){
                $('.buy_left').css({"position":"absolute","left":0,"top":0,"bottom":"auto"});
            }
        }


        /*  锚标记  */
        if(scroH2>=navH2){
            $(".fixLinks").css({"position":"fixed","top":0});
            if(ScreenW>900){
                $('.fixLinks .price').show();
                $('.fixLinks .wrap').css("border","none");
                $('.fixLinks .buy_now').show();
                $('.info_down').css("padding-top","60px");
            }
        }else if(scroH2<navH2){
            $(".fixLinks").css({"position":"static"});
            $('.fixLinks .wrap').css("border-bottom","1px solid #ededed");
            $('.fixLinks .price').hide();
            $('.fixLinks .buy_now').hide();
            $('.info_down').css("padding-top","0");
        }
        if(targetTop < detailTop){
            linksChange($("#page1"));
        }else if(targetTop > detailTop && targetTop < newsTop){
            linksChange($("#page2"));
        }else if(targetTop > newsTop && targetTop < downTop){
            linksChange($("#page3"));
        }else if(targetTop > downTop && targetTop < saleTop){
            linksChange($("#page4"));
        }else if(targetTop > saleTop ){
            linksChange($("#page5"));
        }
    });







});







