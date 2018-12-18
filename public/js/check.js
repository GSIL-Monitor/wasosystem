/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){


    /*   产品收藏  */
    $('.addCollection').on("click",function(){
        var cpid=$(this).data('id');
        var uid=$('input[name="uid"]').val();
        var pid=$('input[name="pid"]').val();
        $.post(scurl,{uid:uid,cpid:cpid,pid:pid},function(data){
           if(data.sta=='ok'){
               alert(data.info);
               return false;
           }else if(data.sta=='true'){
                alert(data.info);
               location.reload();
                return false;
            }else{
                alert(data.info)
                return false;
            }
        });
    });



});











