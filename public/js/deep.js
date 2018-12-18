/**
 * Created by 821 on 2017/10/24.
 */
$(document).ready(function(){
    $(document).on("mouseover","#header",function(){
        $(".headBg").stop().addClass("headerOpend");
        $(this).find(".wrap").removeClass("noBg");
    });
    $(document).on("mouseleave","#header",function(){
        $(".headBg").stop().removeClass("headerOpend");
        $(this).find(".wrap").addClass("noBg");
    });
    /*视觉差*/
    var p=0,t=0;
    var picP = 0;
    var Wwid = $(window).width();


    // if(Wwid>900){
    //     $(document).scroll(function(){
    //         p = $(window).scrollTop();
    //         if(p>t){
    //             picP -= 3;   //down
    //         }else if(p==0){
    //             picP = 0;   //up
    //         }else{
    //             picP += 3;   //up
    //         }
    //         if(picP>=0){
    //             picP=0;
    //         }
    //         $(".body .big_bg").css({"background-position-y":picP});
    //         t = p;
    //    });
    // }else{
    //     var liW = parseInt(liW = Wwid / 2.4);
    //     $(".serverTable ul").css("width",liW * 4 +40 );
    //     $(".serverTable ul li").css("width",liW);
    // }


    /* 品牌化图片转换 */
    $(document).on("click",".deepTxt1 .ContentType li",function(){
        var num = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".picBoxs div").eq(num).addClass("active").siblings("div").removeClass("active");
    });
    $(document).on("click",".deepTxt1 .goLeft",function(){
        var num = $(".deepTxt1 .ContentType .active").index() - 1 ;
        var AllNum = $(".deepTxt1 .ContentType li").length -1;
        if(num<0){num=AllNum;}
        $(".deepTxt1 .ContentType li").eq(num).trigger("click");
    });
    $(document).on("click",".deepTxt1 .goRight",function(){
        var num = $(".deepTxt1 .ContentType .active").index() + 1 ;
        var AllNum = $(".deepTxt1 .ContentType li").length -1;
        if(num>AllNum){num=0;}
        $(".deepTxt1 .ContentType li").eq(num).trigger("click");
    });


    setTimeout(function(){$(".deepTxt1").addClass("ActiveDiv")},500);
    $(".LC ul li:nth-child(2n)").addClass("rightLi");


    /*  相关视频  */
    var liLength  = $(".videos li").length;
    var active  = $(".videos .active").index();
    var This  = $(this).parents("li").index();
    $(".videos li:lt("+active+")").addClass('leftLi');
    $(".videos li:gt("+active+")").addClass('rightLi');
    $(".videoBox .active").prev("li").addClass("readyLi");
    $(".videoBox .active").next("li").addClass("readyLi");

    function checkVideo(){
        $(".videos li").each(function(){
            $(this).removeClass("readyLi").find("video").trigger("pause");
        });
        $(".videoBox .active").prev("li").addClass("readyLi");
        $(".videoBox .active").next("li").addClass("readyLi");
    }

    $(document).on("click",".videoBox .left",function(){
        var num = $(".videos .active").index()+1;
        if(num>1){
            $(".videos .active").removeClass().addClass("rightLi").prev("li").removeClass().addClass("active");
        }
        checkVideo();
    });
    $(document).on("click",".videoBox .right",function(){
        var num = $(".videos .active").index()+1;
        if(num<liLength){
            $(".videos .active").removeClass().addClass("leftLi").next("li").removeClass().addClass("active");
        }
        checkVideo();
    });


    // $(document).on("click",".videos .choose",function(){
    //     var active  = $(".videos .active").index();
    //     var This  = $(this).parents("li").index();
    //     if(active > This){
    //         $(".videos .active").removeClass().addClass("rightLi");
    //     }else{
    //         $(".videos .active").removeClass().addClass("leftLi");
    //     }
    //     $(this).parents("li").removeClass().addClass("active");
    //     checkVideo();
    // });





    /*  手机端操作  */
   if(Wwid<900){
       $(document).on("click",".CB li",function(){
           if($(this).hasClass("opend")){
               $(this).removeClass("opend").find("p").slideUp();
           }else{
               $(this).addClass("opend").find("p").slideDown();
           }
       });
       $(".deepTxt6 .ThrLi ul").css("width",parseInt(Wwid/4*9));
       $(".deepTxt6 .ThrLi li").css("width",parseInt(Wwid/4*3));
       $(".deepTxt1 .picBoxs").css("height",parseInt(Wwid/2));
   }



});