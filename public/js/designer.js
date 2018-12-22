/**
 * Created by john on 2016/7/8.
 */
function time(){
    var i= Math.floor(Math.random()*2+2);
    var countdown = null;
    function timeShow(){
        i--;
        if(i<1){
            clearInterval(countdown);
            $(".proShowList .waitPro").fadeOut(300);
            $(".proShowList .proList").fadeIn(300);
        }
    }
    countdown = setInterval(timeShow,1000);
}

function changeBg(a){
    a.addClass("errorDl");
    a.addClass("redbg");
    a.addClass("edit");
    var errorTop = a.offset().top;
    $("html,body").animate({scrollTop:errorTop}, 500);
    var i= 3;
    var countdown = null;
    function timeShow(){
        i--;
        if(i<1){
            clearInterval(countdown);
            a.removeClass("redbg");
        }
    }
    countdown = setInterval(timeShow,1000);
}


/*  检测提交条件 */
function check(){
    var result = "no";
    $('.checkDiy ul').each(function(){
        var activeLiL= $(this).find(".active").length;
        if(activeLiL<=0){
            changeBg($(this).parents("dl"));
            return false;
        }
    });
    if($(".checkDiy dl").hasClass("errorDl")){
        result = "no";
    }else{
        result = "ok";
    }
    return result;
}

$(document).ready(function(){


    var bodyWidth = $(document).width();

    /* 每个模板执行动画  */
    $('.body .txtCon').each(function(){
        $(this).attr("dataTop",$(this).offset().top);
    });

    $(window).scroll(function(){
        var WindScro = $(window).scrollTop();
        var DivTop  = 0;
        var WindH = $(window).height()*1.1;
        $('.body .txtCon').each(function(){
            if(bodyWidth<900){
                DivTop = $(this).attr("dataTop")-WindH;
            }else{
                DivTop = $(this).attr("dataTop")-800;
            }
            if(WindScro >= DivTop){
                $(this).addClass('ActiveDiv');
            }
        });
    });




    /*  开始定制  */
    $(document).on("click",".goNow",function(){
        $(".big_bg").addClass("big_bgActive");
        $(".goNow").hide();
        $(".designAD").hide();
        $(".SJSEasy").addClass("SJSEasyDone");
        $(".disignDiy").show();
    });

    /*  设计师电脑私人订制  */
    $(document).on("click",".openDisignDiy .openTxt b",function(){
        $(".body .disignList").hide().siblings(".disignDiy").show();
    });

    /* 多选  */
    $(document).on("click",".checkDiy dd .checkBoxLi li",function(){
       var TXT = $(this).text();
       var Name = $(this).attr("name");
       if($(this).hasClass("active")){
           $(this).removeClass("active");
           $(this).parents("dl").children("dt").find("label[name="+Name+"]").remove();
       }else{
           $(this).addClass("active");
           $(this).parents("dl").removeClass("edit errorDl redbg").prev("dl:visible").addClass("done");
           $(this).parents("dl").next("dl").show();
           $(this).parents("dl").find("span").append("<label name="+Name+">"+TXT+"，</label>");
       }
    });
    /* 单选  */
    $(document).on("click",".checkDiy dd .radioLi li",function(){
        $(this).addClass("active").siblings("li").removeClass("active");
        $(this).parents("dl").removeClass("edit errorDl redbg").prev("dl:visible").addClass("done");
        $(this).parents("dl").next("dl").show();
        var TXT = $(this).text();
        var Name = $(this).attr("name");
        $(this).parents("dl").find("span").html("").append("<label name="+Name+">"+TXT+"，</label>");
    });

    /* 展开选择  */
    $(document).on("click",".checkDiy .done dt",function(){
       $(this).children("i").removeClass("ModeIco").addClass("closeMode");
       $(this).parents("dl").addClass("edit").siblings("dl:visible").removeClass("edit").addClass("done");
    });
    /* 收起选择  */
    $(document).on("click",".checkDiy .edit dt",function(){
        $(this).children("i").removeClass("closeMode").addClass("ModeIco");
        $(this).parents("dl").removeClass("edit");
    });
    // /* 显示提交  */
    $(document).on("click",".checkDiy .lastdl li",function(){
        $(".checkDiy .disignDiyBtn").show();
    });








    $(document).on("click",".gotoBack",function(){
        $(".body .proShowList").hide().siblings(".checkDiy").show();
        $(".proShowList .waitPro").show();
        $(".proShowList .proList").hide();
    });





    /*   =====================  设计师电脑定制 =========================     */

   $(document).on("click",".SJStxt0 .ShowLi ul li",function(){
       $(".SJStxt0 .ShowLi li").removeClass();
       $(this).addClass("active");
       var index= $(this).attr("dataNum");
       $('.ShowLi .Dls').removeClass("active");
       $('.ShowLi').find(".Dls").eq(index).addClass("active");
   });


    /*   =====================  IT服务 =========================     */

    $(document).on("click",".serverName li",function(){
        var index = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".serverPage .sPage").eq(index).addClass("active").siblings(".sPage").removeClass("active");
    });

    $(document).on("click",".serverTable .serverTypes li",function(){
        var index = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".serverTable .serversTable .UlBox").eq(index).addClass("activeUlBox").siblings(".UlBox").removeClass("activeUlBox");
    });


    if(bodyWidth<900){
        $(document).on("click",".serverTable li",function(){
            if($(this).hasClass("showLi")){
                $(this).removeClass("showLi");
            }else{
                $(this).addClass("showLi").siblings("li").removeClass("showLi");
            }
        });
    }

});







