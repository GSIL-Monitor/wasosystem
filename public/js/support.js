/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

    $('.other_box .borderTwo a').mouseenter(function(){
        $(this).children(".hideP").stop().fadeIn(300);
    });
    $('.other_box .borderTwo a').mouseleave(function(){
        $(this).children(".hideP").stop().fadeOut(300);
    });
    /*  联系我们移动 */



    /*  手机端  问题类展开  */
   $('.dl_box dl dt').toggle(
       function(){
          $(this).next('.dl_hide').slideDown(200);
       },function(){
        $(this).next('.dl_hide').slideUp(200);
       }
    );





});









