/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

   /*  员工生活图片  */
    $('.life .smalls li').on("click",function(){
        var index=$(".life .smalls li").index(this);
        var url = $(this).children("a").children("img").attr("src");
        $(".life_pic").children(".life_box").children("img").attr("src",url)
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".smalls .word p").eq(index).show().siblings("p").hide();
    });
    $("#lookPic .rightArrow").on("click",function(){
        $("#lookPic").trigger("swipeleft");
    });
    $("#lookPic .leftArrow").on("click",function(){
        $("#lookPic").trigger("swiperight");
    });


});







