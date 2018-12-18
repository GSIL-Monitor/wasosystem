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
    var form_data = $('#demand_managements').fixedSerialize();
    axios.post(url, form_data).then(function (response) {
        swal({
                title: "添加成功！",
                text: "生成订单成功！",
                type: "success",
            }).then(function(){
                toastrMessage('success', response.data.info, 'top')
            });
    }).catch(function (err) {
        toastrMessage('error', err.response.data.info)
    })
}
//获取整机差额
function get_machine_balance(url) {
        var name = $('.name').val();
       var  order_type=$('.order_type');
       var total_prices=parseInt($('.total_prices').val())
       if(order_type !='parts' && order_type.val() != '0'){
           axios.post(url, {"name":name}).then(function (response) {
             var price_spread=parseInt(response.data)
            $('.price_spread').val(price_spread)
            $('.total_prices').val(total_prices+price_spread)
           }).catch(function (err) {

           })
       }
}
function filtrate(obj,url) {
    var id=obj.val();
    obj.parent().nextAll().remove()
    if(id !='0' && id !=''){
        obj.parent().after("<div class='shaixuanItem'><select class='filtrate select2' name='filtrate[]'></select></div>");
        var $select = obj.parent().next().find('.filtrate');
        var instance;
        var data = [];
        axios.post(url,
            {"id":id}
        ).then(function (response) {
            console.log(response.data.length);
            if(response.data.length == 0){
                obj.parent().next().empty();
            }else{
                $.each(response.data,function (key,item){
                    data.push({id:'' + key, text:item});
                });
                instance = $select.data('select2');
                if(instance){
                    $select.select2('destroy').empty();
                }
                $select.select2({
                    placeholder: '请选择一个',
                    data: data
                });
            }


        });
    }
}
$(function () {

    $(document).on('click', '.create_orders', function () {
        var url = $(this).attr('data_url');
        checkOrderType(url);
    });
    $(document).on('change','.filtrate',function () {

    })
});