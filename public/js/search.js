/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
    $(".msg").hide();
    $(".searchTypePage li").eq(0).addClass("active");
    $(".searchResultBox .searchResultPage").eq(0).addClass("active");
    $(".searchResultBox .searchSol li:nth-child(3n)").addClass("last");
    $(".searchResultBox .searchPro dd:nth-child(4n)").addClass("last");

    $(document).on("click",".searchTypePage li",function(){
        var index = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".searchResultBox .searchResultPage").eq(index).addClass("active").siblings(".searchResultPage").removeClass("active");
    });


    $("#search").click(function(){
        var search= $(".search_text").val();
        if(search.trim() ==""){
            $(".msg").html('搜索框文本不能为空！');
            $(".msg").fadeIn(1000);
            $(".msg").fadeOut(1000);
            $(".search_text").focus();
            return false;
        }else{
            return true;
//
        }});
    $("#p_header h5").text("搜索");


   $(document).on("click",".lookAll",function(){
       $(this).siblings(".more_hide").slideDown();
       $(this).hide();
   });


});







