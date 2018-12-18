/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
    try{
        var navH2 = $(".detail_ul").offset().top;
    }
    catch(e){}
    $(window).scroll(function(){
        try{
            var scroH2 = $(this).scrollTop();
        }
        catch(e) {}
        try {
            if(scroH2>=navH2){
                $(".detail_ul").css({"position":"fixed","top":0,"border-bottom":"1px solid #dedede","background":"#fff"});
                $('.fixedMenu').show();
            }else if(scroH2<navH2){
                $(".detail_ul").css({"position":"static","border-bottom":"none","background":"none"});
                $('.fixedMenu').hide();
            }
        } catch(e) {}
    });
    /*  固定目录 */

    //锚：
    $('a[href*=#],area[href*=#]').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body').animate({
                        scrollTop: targetOffset
                    },
                    1000);
                return false;
            }
        }
    });

        var subNav_active = $(".active");
        var subNav_scroll = function(target){
            subNav_active.removeClass	("active");
            target.parent().addClass("active");
            subNav_active = target.parent();
        };
        //页面跳转时定位


        if(window.location.hash){
            var targetScroll = $(window.location.hash).offset().top -70;
            $("html,body").animate({scrollTop:targetScroll},300);
        }
        $(window).scroll(function(){
            var $this = $(this);
            var targetTop = $(this).scrollTop();
            var footerTop = $("#foot").offset().top;
            var height = $(window).height();
            var c2h = $('.detail').offset().top;
            var c3h = $('.news').offset().top;
            var c4h = $('.down').offset().top;
            var c5h = $('.sale_records').offset().top;
            if(targetTop < c2h){
                subNav_scroll($("#c1"));
            }else if(targetTop > c2h && targetTop < c3h){
                subNav_scroll($("#c2"));
            }else if(targetTop > c3h && targetTop < c4h){
                subNav_scroll($("#c3"));
            }else if(targetTop > c4h && targetTop < c5h){
                subNav_scroll($("#c4"));
            }else if(targetTop > c5h){
                subNav_scroll($("#c5"));
            }
        });
         //锚标记变化

        $('.more').click(function(){
            if($(this).hasClass('hide')){
                $(this).removeClass('hide').html("更多").siblings('dl').animate({height:"40"},200);
            }else{
                var Dd = $(this).siblings('dl').children('dd');
                var Height = Math.ceil(Dd.length/6)*40;
                $(this).addClass('hide').html("收起").siblings('dl').animate({height:Height},200);
            }
        });





});









