/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
     $('.choose select').focus(function(){
             $(this).next('img').rotate({animateTo:180});
     });
    $('.choose select').blur(function(){
        $(this).next('img').rotate({animateTo:0});
    });
    /*   仿select箭头  */

    /*  特种定制 li 加mid */
    /*   默认 列表第3个加class */
    var ProList = $('.special_box ul li');
    for(var i=0; i<ProList.length; i++){
        if((i+1)%4 == 0){
            ProList.eq(i).addClass('last');
        }
    }

    /*
    //弹出层JS
    var screenW = $(window).width();
    var pageL = $('.info_contact li').length;
    var ulW = pageL * screenW;
    $('.info_contact ul li').width(screenW);
    $('.info_contact ul').width(ulW);
    for(var i=1; i<=pageL; i++){
        $('.pages').append("<li>"+i+"</li>");
    }
    $('.pages li').eq(0).addClass('active');
    $('.totle_page').html(pageL);
    $('.info_contact li').each(function(){
        var picIndex = $('.info_contact ul li').index(this)+1;
        $(this).children('.info_wrap').children('.info_word').children('.pageNum').children('.now_page').html(picIndex);
    });
    /*   特种定制 弹出层ul宽  各种默认*/
    /*
    $('.cus_info .pages li').bind("click",function(){
        var index = $('.pages li').index(this);
        var targetLeft = index * (-screenW);
        $(this).addClass('active').siblings('li').removeClass();
        $('.info_contact ul').stop().animate({left:targetLeft},500);
    });
    /*   点击换页  */

    /*
    $('.control .go_next').bind("click",function(){
        var MaxLeft = -screenW * (pageL - 1);
        var ulLeft = $('.info_contact ul').position().left;
        var targetLeft = ulLeft - screenW
        var pageLi = $('.pages').find('.active');
        if(ulLeft > MaxLeft){
            $('.info_contact ul').stop().animate({left:targetLeft},500);
            pageLi.next('li').addClass('active').siblings("li").removeClass();
        }else{
            return false;
        }
    });

    $('.control .go_pre').bind("click",function(){
        var ulLeft = $('.info_contact ul').position().left;
        var targetLeft = ulLeft + screenW
        var pageLi = $('.pages').find('.active');
        if(ulLeft < 0){
            $('.info_contact ul').stop().animate({left:targetLeft},500);
            pageLi.prev('li').addClass('active').siblings("li").removeClass();
        }else{
            return false;
        }
    });
    /*  上下页  */



    $('.special_box li').bind("click",function(){
        $('.cus_info').show();
    })
    $('.cus_info .close').bind("click",function(){
         $('.cus_info').hide();
    });
    $('.in_price').change(function(){
        var Price = $(this).val();
        var MaxPrice = 10000;
        var Persent = 1 - (Price/MaxPrice).toFixed(2);
        var Height = Math.ceil(300 * Persent);
        $(".price_box .Now_price span").text(Price);
        $('.water_line').animate({bottom:-Height},1000);
        if(Persent<=0.5){
            $('.Now_price').animate({color:"#fff"},200);
            $('.Now_price span').animate({color:"#fff"},200);
            $('.Now_price h5').animate({color:"#fff"},200);
        }else{
            $('.Now_price').animate({color:"#2c94e0"},200);
            $('.Now_price span').animate({color:"#2c94e0"},200);
            $('.Now_price h5').animate({color:"#666"},200);
        }
        if(Price>=MaxPrice){
            $('.price_box').css("background","#2c94e0");
        }else{
            $('.price_box').css("background","#f1f1f1");
        }
    });
    /*  价格动画  结束 */




});







