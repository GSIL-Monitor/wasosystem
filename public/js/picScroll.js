/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

    var WindW = $(window).width();
    var WindH = $(window).height();
    var LiWidth = $("#lookPic").width();
    var UlLenght = $(".scroll_pic li");

    for(var i=0; i<UlLenght.length; i++){
        $("#lookPic .points").append("<li></li>");
    }
    $("#lookPic .points li").eq(0).addClass("point_active");
    $("a").attr('data-ajax',false);
   /*  添加锚点 */


    $('.scroll_pic li').on("click",function(){
        var bodyW = $(window).width();
        var LiHeight = $("#lookPic").height();
        var LiLenght = $(this).parents("ul").children('li').length;
        var UlWidth = LiLenght * LiWidth;
        var liIndex = $('.scroll_pic li').index(this);
        var UlLeft = -liIndex *  WindW;
        if(bodyW<900){
            $("#lookPic .main_pic ul li span img").css({"width":"80%"});
        }else{
            $("#lookPic .main_pic ul li span img").css({"height":"80%"});
        }
        $('#head_black').fadeIn();
        $('#lookPic').show();
        $('#lookPic .main_pic').css({"height":LiHeight});
        $('#lookPic .main_pic ul').css({"width":UlWidth,"height":LiHeight,"left":UlLeft});
        $("#lookPic .main_pic ul li").css({"width":LiWidth,"height":LiHeight});
        $("#lookPic .points li").removeClass("point_active").eq(liIndex).addClass("point_active");
    });
    /*   点击展开图片预览  */

    $("#lookPic .points li").bind("click",function(){
        var index = $("#lookPic .points li").index(this);
        var UlLeft = -index * LiWidth;
        $(this).addClass("point_active").siblings("li").removeClass("point_active");
        $("#lookPic .main_pic ul").animate({left:UlLeft},300);
    })
    /*   展示图锚点  */

    $("#lookPic").on("swipeleft",function(e){
        $("#lookPic .points .point_active").next().trigger("click");
    });
    $("#lookPic").on("swiperight",function(e){
        $("#lookPic .points .point_active").prev().trigger("click");
    });
    /*   左右滑动  */

    $("#lookPic .close").on("click",function(){
       $("#lookPic").hide();
        $('#head_black').fadeOut();
    });
    /*   关闭弹出层 */






});









