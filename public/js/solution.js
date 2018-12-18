/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
    var navHeight= $(".solutionType").offset().top;
    var navFix=$(".solutionType");
    $(window).scroll(function(){
        if($(this).scrollTop()>navHeight){
            navFix.addClass("fixedType");
        }
        else{
            navFix.removeClass("fixedType");
        }
    });

    //内容信息导航锚点
    // $('.solutionType').navScroll({
    //     mobileDropdown: true,
    //     mobileBreakpoint: 768,
    //     scrollSpy: true
    // });
    //
    // $('.click-me').navScroll({
    //     navHeight: 0
    // });

    $('.solutionType').on('click', '.nav-mobile', function (e) {
        e.preventDefault();
        $('.solutionType ul').slideToggle('fast');
    });


    $(document).on("click",".typeName",function(){
       if($(this).children("i").hasClass("closeI")){
           $(this).children("i").removeClass("closeI");
           $(this).siblings("ul").slideUp(500);
       }else{
           $(this).children("i").addClass("closeI");
           $(this).siblings("ul").slideDown(500);
       }
    });


});
