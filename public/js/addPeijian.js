/**
 * Created by john on 2016/11/16.
 */
/**
 * Created by john on 2016/7/8.
 */
function checkProducts() {
    var products='';
    var flag=false;
    $.each($('.listTable').find('.num'), function () {
        var product = $(this).find('.good_num');
        var product_name = product.attr('product-name');
        products += product_name + ','
    });
    if(isset(products,'CPU') && isset(products,'主板') && isset(products,'机箱') && isset(products,'电源')|| isset(products,'CPU') && isset(products,'平台')){
        flag=true;
    }
    return flag;
}
//保存为整机
function confirm_complete_machine(url) {
    swal({
        title: '您所选的配件符合一套整机,你想保存为整机吗?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '保存为设计师电脑！',
        cancelButtonText: '保存为定制整机'
    }).then(function () {
        designer_computer(url);
    },function (dismiss) {
        if (dismiss === 'cancel') {
            custom_complete_machine(url);
        }
    });
}
function checkOrderType(url) {
    var count = 0;
    var  order_type= $('.order_type').val();
    $(".selectIds").each(function () {
        count++;
    });
    if(order_type =='parts' && checkProducts() ==true){
        swal({
            title: '您所选的配件符合一套整机,你想保存为整机吗?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '保存为整机！',
            cancelButtonText: '保存为配件'
        }).then(function () {
            confirm_complete_machine(url)
        },function (dismiss) {
            if (dismiss === 'cancel') {
                parts(url);
            }
        });
    }else{
        if (count <= 0) {
            swal('请至少添加一个产品', '', 'error');
            return false;
        }
        create_orders(url);
    }

}
//定制整机
function custom_complete_machine(url) {
    $('.code').val(2);
    $('.order_type').val('custom_complete_machine');
    ConfigurationCodeCreate();
    qrcodeCreate();
    zheng_JiXingHao_Create();
    create_orders(url)
}
//设计师电脑
function designer_computer(url) {
    $('.code').val(4);
    $('.order_type').val('designer_computer');
    ConfigurationCodeCreate();
    qrcodeCreate();
    zheng_JiXingHao_Create();
    create_orders(url)
}
//设计师电脑
function parts(url) {
    $('.code').val(1);
    $('.name').val('');
    ConfigurationCodeCreate();
    qrcodeCreate();
    create_orders(url)
}
function create_orders(url) {
    var form_data = $('.product_form').fixedSerialize();
    axios.post(url, form_data).then(function (response) {
        swal({
            title: "添加成功！",
            text: response.data.info,
            type: "success",
        }).then(function(){
            toastrMessage('success', response.data.info, 'top')
        });
    }).catch(function (err) {
        toastrMessage('error', err.response.data.info)
    })
}

/*   每个产品默认价格 */
function price_sum() {
    var is_type=$('.checked').attr("data-id");
    var shuidian=$('.shuidian').val();
    $('.orderTable .orderList').each(function(){
        var num = parseInt($(this).children(".num").find(".good_num").val());
        if(num<=1){
            $(this).children(".num").find(".good_num").siblings('.delNum').addClass('none');
        }
        var danjia = parseInt($(this).children('.price').children('.pri').attr('data-id'));
        if(is_type =='no_invoice'){
            danjia=Math.ceil(danjia*shuidian);
            $(this).children('.price').children('.pri').text(danjia);
        }else{
            $(this).children('.price').children('.pri').text(danjia);
        }
        var to = parseInt(num * danjia);
        $(this).children(".total").children('.to').text(to);
    });
}



/*   单选 多选 全选 计算总金额和数量  */
function TotaoAll(){
    var sum = 0;
    $(".orderTable .orderList").each(function(){
        if(!isNaN($(this).children(".total").children(".to").html())){
            sum +=parseInt($(this).children(".total").children(".to").html());
        }
    });
    $('.AllPri').html(sum);
    $('.total_prices').val(sum);
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


    $(document).on('click', '.create_orders', function () {
        var url = $(this).attr('data_url');
        checkOrderType(url);

    });

    price_sum();
    TotaoAll();

	
	
    /*  单选  计算总价 */
    $(".selectIds").on("change",function(){
        var AllProLength = $('.orderTable .orderList').length;
        var Num = $(".orderList .selectIds:checked").length;
		if(Num>=1){
			if(AllProLength == Num ){
			   $('.selectAll').attr("checked",true);	
			}else{
			   $('.selectAll').attr("checked",false);	
			}
			TotaoAll();	
		}else{
			$('.confirm_btn .AllPri').text("0");
			$('.selectAll').attr("checked",false);
		}

    });
    /*  全选  单选 */
    $(".selectAll").on("change",function(){
        if($(this).is(":checked")){
            $(".orderTable .selectIds").attr("checked", true);
        }else{
            $(".orderTable .selectIds").attr("checked", false);
        }
    });
	/*查看是否含税*/
    $(".invoice_type").on("click",function(){
        var NowNum = $(this).addClass('checked').siblings().removeClass('checked');
        var type=$(this).attr('data-id')
        $(".invoice_type").val(type);
        price_sum();
        TotaoAll();
    });
		
     /*   增加产品  */
    $(".num_box .addNum").on("click",function(){
        var NowNum = $(this).siblings(".good_num").val();
        NowNum ++ ;
        $(this).siblings(".good_num").val(NowNum);
        $(this).siblings(".delNum").removeClass("none");
        price_sum();
        TotaoAll();
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
            price_sum();
            TotaoAll();
        }
    });
    $('.good_num').bind("blur",function(){
		var checkBox = $(this).parents('.orderList').find('.selectIds');
		if(checkBox.is(":checked")){
		   price_sum();	
		   TotaoAll();
		}else{
		   price_sum();	
		}
        
    });




});