/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){
    //  在线客服
    $(".talkBtn").on("click",function () {
        var url=$(this).attr('data-src');
        layer.open({
            type: 2,
            title: '网烁客服',
            title: '网烁客服',
            shadeClose: true,
            shade: 0,
            area: ['580px', '600px'],
            content: url
        });
    });

});







