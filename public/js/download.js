/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

   /*  下载收缩图标变化  */
    $('.down_list h2').toggle(function(){
        $(this).children('i').css("background-position","-90px -235px");
        $(this).siblings('ul').slideUp(300);
        $(this).css("border-bottom","none");
    },function(){
        $(this).children('i').css("background-position","-90px -210px");
        $(this).css("border-bottom","1px solid #dedede")
        $(this).siblings('ul').slideDown(300);
    });

    /*   下载列表边框隐藏  */

    $('.info_box div').each(function(){
        var DownLi = $(this).children('ul').children('li');
        for(i=0; i<DownLi.length; i++){
            if((i+1)%5==0){
                DownLi.eq(i).css("border-right","none");
            }
        }
        if(DownLi.length % 5 ==0){
            DownLi.slice(-5).css("border-bottom","none");
        }else if(DownLi.length % 5 ==4){
            DownLi.slice(-4).css("border-bottom","none");
        }else if(DownLi.length % 5 ==3){
            DownLi.slice(-3).css("border-bottom","none");
        }else if(DownLi.length % 5 ==2){
            DownLi.slice(-2).css("border-bottom","none");
        }else if(DownLi.length % 5 ==1){
            DownLi.slice(-1).css("border-bottom","none");
        }
    });



});







