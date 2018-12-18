$(function () {
    var bodyW = $(window).width();
    $("#header .wrap").addClass("noBg");
    $(".UlBox li:nth-child(2n)").addClass("evenLi");
    $(".disignDiy .serverBox:nth-child(2n)").addClass("evenDiv");
    $(".proList ul li:nth-child(4n)").addClass("last");
    $(".disignDiy .serverBox").eq(2).addClass("serverBoxB");
    $(".disignDiy .serverBox").eq(3).addClass("serverBoxB");
    setTimeout(function(){
        $(".txtCon").eq(1).addClass("ActiveDiv")
    },500);
    /* IT服务  head背景  */
    $(document).on("mouseover","#header",function(){
        $(".headBg").stop().addClass("headerOpend");
        $(this).find(".wrap").removeClass("noBg");
    });
    $(document).on("mouseleave","#header",function(){
        $(".headBg").stop().removeClass("headerOpend");
        $(this).find(".wrap").addClass("noBg");
    });
    $("#p_header h5").text("IT服务外包");
    $('.disignDiy dl').eq(0).css("display","block");
    $(".serversTable li:nth-child(4n)").addClass("last");
    if(bodyW<=900){
        $(".serverBox2").each(function(){
            var phoneBg = $(this).attr("data_phone");
            $(this).css("background-image","url("+ phoneBg +")");
        });
    }
    $(function () {
        $(document).on('click','.it_save',function () {
            var url = $(this).attr('data_url');
            var csrf_token = getToken();
            var title=$(this).attr('data_title');
            var num=$(this).attr('data_num');
            var price=$(this).attr('data_price');
            var total_price=$(this).attr('data_total_price');

            swal({
                title: '您确定要将<br/>'+title+'<br/>保存为意向订单吗？',
                text: '操作后将生成一条订单!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定生成！',
                cancelButtonText: '取消'
            }).then(function (dismiss) {
                axios.post(url, {
                    "_token": csrf_token,
                    "_method": "post",
                    "num":num,
                    "price":price,
                    "total_price":total_price
                })
                    .then(function (response) {
                        swal('生成意向订单成功！','','success').then(function () {
                            window.location.href='/orders/'+response.data
                    })
                    })
                    .catch(function (err) {
                        swal('生成意向订单失败！','','error');
            });
        });
    });


})