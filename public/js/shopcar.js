/**
 * Created by john on 2016/11/16.
 */
/**
 * Created by john on 2016/7/8.
 */


/*   每个产品默认价格 */
function CompleteMachinePartsTotaoAllPriceNum() {
    var invoice_type=$("input[name='invoice_type']:checked").val();
    var shuidian=$('.shuidian').val();
    var sum =0;
    var product_num = 0 ;
    $('.orderTable .complete_machine_parts').each(function(){
        var num = parseInt($(this).children(".num").children(".num_box").children(".good_num").val());
        var pri = parseInt($(this).children('.price').children('.pri').attr('data-id'));
        var danjia=0;
        if(invoice_type == "no_invoice"){
            danjia = Math.ceil((pri)*shuidian);
        }else{
            danjia =pri;
        }
        var to = num * danjia;
        sum += to;
        product_num += nums;
        $(this).children('.price').children('.pri').text(danjia);
        $(this).children(".total").children('.to').text(parseInt(to));
    });
    return sum;
}
function partsTotaoAllPriceNum() {
    var invoice_type=$("input[name='invoice_type']:checked").val();
    var shuidian=$('.shuidian').val();
    var sum =0;
    var product_num = 0 ;

    $(".proTotalNum").text(product_num);
    $('.orderTable .orderList').each(function(){
        var nums = parseInt($(this).children(".num").find(".good_num ").val());
        var pri = parseInt($(this).children('.price').children('.pri').attr('data-id'));

        var danjia=0;
        if(invoice_type == "no_invoice"){
            danjia = Math.ceil((pri)*shuidian);
        }else{
            danjia =pri;
        }
        var to = nums * danjia;
        sum += to;
        product_num += nums;

        $(this).children('.price').children('.pri').text(danjia);
        $(this).children(".total").children('.to').text(parseInt(to));
    });

    return sum;
}

//服务模式计算
function service() {
    var service_price=parseInt($('.service_status:checked').val());
    var num=$('input[name="num"]').val();
    var serviceTotal= num * service_price;
    $(".service_price").text(serviceTotal);
    return serviceTotal;
}




//所有产品合计
function AllPriceTotal(){
    var num=$('input[name="num"]').val();
    var order_type=$('.order_type').val();
    var product_num= 0;
    if(order_type !='parts'){
        var price=CompleteMachinePartsTotaoAllPriceNum();
    }else{
        var price=partsTotaoAllPriceNum();
    }
    $('.orderTable .orderList').each(function(){
        var nums = parseInt($(this).children(".num").find(".good_num ").val());
        product_num += nums;
    });

    $(".proTotalNum").text(product_num);
    $('.danjia').text( price );
    $('.AllPri').text(price * num);
    $('.total_to').text(price * num);
    $('.Pro_Total').text(price * num);
    var total_price = ( price + service() ) * num;
    $('#price').val(total_price);//应付价格（含服务费）
    $('#unit_price').val(price);//应付价格（含服务费）
    $('.total_prices').text(total_price);

}
$(document).ready(function(){

    /*  购物车 手机端编辑  */
    $('.editShop').toggle(function(){
        $(this).text("完成");
        $('.orderList .control').show();
    },function(){
        $(this).text("编辑");
        $('.orderList .control').hide();
    });

    CompleteMachinePartsTotaoAllPriceNum();
    AllPriceTotal();

    /*   增加产品  */
    $(".num_box .addNum").on("click",function(){
        var NowNum = $(this).siblings(".good_num").val();
        NowNum ++ ;
        $(this).siblings(".good_num").val(NowNum);
        $(this).siblings(".delNum").removeClass("none");
        AllPriceTotal();
    });
    /*   减少产品  */
    $(".num_box .delNum").on("click",function(){
        if($(this).hasClass("none")){
            return false;
        }else {
            var NowNum = $(this).siblings(".good_num").val();
            NowNum--;
            if (NowNum <= 1) {
                $(this).addClass("none");
                $(this).siblings(".good_num").val(NowNum);
            } else {
                $(this).siblings(".good_num").val(NowNum);
                $(this).removeClass("none");
            }
            AllPriceTotal();
        }
    });
    $('.good_num').bind("blur",function(){
        AllPriceTotal();
    });




    /*   自选查看  */
    $(".lookDetail").on("click",function(){
        var Width = $(window).width();
        if(Width<900){
            $(".Mydetail").css({"max-height":"100%","height":"100%"});
            $(".Mydetail").stop().animate({top:0},300);
        }else{
            $(".Mydetail").stop().animate({top:"10%"},300);
        }
        $("#head_black").css("z-index",9991).fadeIn(300);
    });


    // $(".DoneControl span").on("click",function(){
    //     $("#head_black").fadeOut(300);
    //     $(".pro_detail").stop().animate({top:"-900px"},300,function(){
    //         $(this).css({"max-height":"70%","height":"auto"});
    //     });
    //     $(".Mydetail").stop().animate({top:"-900px"},300,function(){
    //         $(this).css({"max_height":"70%","height":"auto"});
    //     });
    // });



  //意向订单 至 下单订货
    $(document).on('click', ".order_save", function () {
        var add_rule_form = $(".order_edit").serialize();
        var status=$(this).attr('data-status');
        var url=$(this).attr('data-url');
        axios.post(url,add_rule_form+'&order_status='+status)
            .then(function (response) {
                toastrMessage('success',response.data.info,'static')
                window.location=location_url+'?order_status='+response.data.status
            })
            .catch(function (err) {
                if(err.response.data.info){
                    toastrMessage('error',err.response.data.info)
                }else{
                    swal(err.response.data.message,
                        '请根据提示操作！',
                        'warning')
                }
            })
    });




});