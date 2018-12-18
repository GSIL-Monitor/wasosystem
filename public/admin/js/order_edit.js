

/*    每个产品合计 */
function A_proPriceTotal(){
    var sum = 0;
    var price_spread=parseInt($('.price_spread').val());
    $(".pro_detail .detail_inner tr").not(".tit").each(function(){
        var pri = parseInt($(this).find(".A_price").text());
        var num = parseInt($(this).find(".A_num").children('.A_numbox').children(".good_num").val());
        num=num?num:1;
        var TotalPri = pri * num;
        $(this).find(".A_prices").text(TotalPri);
        sum += TotalPri;
    });
    sum=parseInt(sum+price_spread);

    $('.A_allTotal b').text(sum);
    $('.total_prices').val(sum);

}

//散热器 CPU的实际数量 就是散热器的实际数量
function radiation() {
    var cpu_num=$('.B').children('.A_num').children('.A_numbox').children('.good_num').val();//cpu实际数量
    $('.L').children('.A_num').children('.A_numbox').children('.good_num').val(cpu_num);
}
//平台散热器
function PlatformRadiator($cpunum) {
    var PlatformRadiator=$('.PlatformRadiator').val();
    var terrace_price=parseInt($('.A').find(".A_price").attr('data-id'));
    var terrace_num=parseInt($('.A').find(".good_num").val());
    var terrace_id=parseInt($('.A').find(".good_num").attr('good-id'));
    if(PlatformRadiator!=undefined){
        if($cpunum>1){
            terrace_price=(terrace_price+($cpunum*PlatformRadiator))-PlatformRadiator;
        }else{
            terrace_price=terrace_price;
        }
        $('.A').find(".A_price").text(terrace_price);
        $('.A').find(".A_prices").text(terrace_num*terrace_price);
    }
}

//检查硬盘raid
function checkRaids(raid,val,type) {
    if(type==1){
        raid.parents('.A_num').siblings('.raids').children('select').find('option:selected').removeAttr("selected");
    }
    if((val % 2)==0 && val>=6){
        raid.parents('.A_num').siblings('.raids').children('.raid4').show();
        raid.parents('.A_num').siblings('.raids').children('.raid4').siblings().hide();
    }else if((val % 2)==0 && val>=4){
        raid.parents('.A_num').siblings('.raids').children('.raid3').show();
        raid.parents('.A_num').siblings('.raids').children('.raid3').siblings().hide();
    }else if(val>=3){
        raid.parents('.A_num').siblings('.raids').children('.raid2').show();
        raid.parents('.A_num').siblings('.raids').children('.raid2').siblings().hide();
    }else if( val==2){
        raid.parents('.A_num').siblings('.raids').children('.raid1').show();
        raid.parents('.A_num').siblings('.raids').children('.raid1').siblings().hide();
    }else{
        raid.parents('.A_num').siblings('.raids').children('select').hide();
    }
}
//硬盘
function hard_disk() {
    var b=0;
    $.each($('.E'),function () {
        b++;
        checkRaids($(this).find('.good_num'),$(this).find('.good_num').val(),2)
    });
    if(b>1){
        $('.E').children('.A_caozuo').children('.selectIds').show();
    }else{
        $('.E').children('.A_caozuo').children('.selectIds').hide();
    }

}
/*  默认检查数量 */
function A_checkNum(){
    $(".pro_detail .detail_inner .A_numbox").each(function(){
        var max = $(this).attr("maxNum");
        var num=1;
        var is_type=$(this).children().siblings(".good_num ").data('product-bianhao');//编号
        var cpu_num=$('.B').children('.A_num').children('.A_numbox').children('.good_num').val();//cpu实际数量
        var neicun=$('.memory').val();//节点数量
        if(is_type=='D'){num=cpu_num;}
        if(is_type=='B'){num=neicun;}
        var val=$(this).find('.PJnum').val();//当前产品的数量
        if(is_type=='E'){ //如果是硬盘
            checkRaids($(this).children('.PJnum'),val,2)
        }

        if(val==max){

             $(this).children(".A_addNum").addClass("none").siblings('.A_delNum').removeClass("none");
        }
        if(val==1 && val<max){
            $(this).children(".A_delNum").addClass("none").siblings('.A_addNum').removeClass("none");
        }

    });
}
//判断是否有平台
function check_terrace() {
    var terrace=0;
    $.each($(".pro_detail .detail_inner listTable tr:not('.tit')"),function () {
        if($(this).attr('class')=='A'){terrace++;}
    });
    if(terrace==0){
        radiation();
    }
}
//内存
function memory(status) {
    var maxnum=0;
    var memory=$('.memory').val();//节点数量
    var jie_dian_cpu_bing_cun_shu=$('.memory').attr('data-jie_dian_cpu_bing_cun_shu');//节点CPU并存数
    var jie_dian_nei_cun_cha_cao_shu=$('.memory').attr('data-jie_dian_nei_cun_cha_cao_shu');//节点内存插槽数
    var nei_cun_shi_fou_jian_ban=$('.memory').attr('data-nei_cun_shi_fou_jian_ban');//内存是否减半
    var cpunum=parseInt($('.B').children('.A_num').children('.A_numbox').children('.good_num').val());//cpu实际数量
    var good_box=$('.D').children('.A_num').children('.A_numbox');
    var good_num=parseInt(good_box.children('.good_num').val());
    if(nei_cun_shi_fou_jian_ban==1){
        maxnum= ((jie_dian_nei_cun_cha_cao_shu/jie_dian_cpu_bing_cun_shu)*cpunum)*memory;
        good_box.attr('maxnum',maxnum);
        good_box.children('.good_num').val(cpunum);//cpu实际数量
        good_box.children('.good_num').siblings('.A_delNum').addClass("none");
    }else{
        maxnum=jie_dian_nei_cun_cha_cao_shu;
        good_box.attr('maxnum',maxnum);
        good_box.children('.good_num').val(cpunum);//cpu实际数量
        good_box.children('.good_num').siblings('.A_delNum').addClass("none");
    }
}
//修改产品及参数
function edit_product_good(product_good,status) {
    var url=product_good.attr('data_url');
    var product_good_id=product_good.val();
    var num=parseInt(product_good.parent('.A_name').siblings('.A_num').children('.A_numbox').children('.good_num').val());
    var order_num=$('.order_num').val();
    var product_good_num=order_num * num;
    var product_good_number=product_good.parent('.A_name').siblings('.A_num').children('.A_numbox').children('.good_num').attr('product-bianhao');
    var product_good_raid=product_good.parents('.A_name').siblings(".raids").children('select:visible').val();
    product_good_raid=product_good_raid?product_good_raid:''
    var old_id=product_good.attr('old_id');
    if(product_good_id){
        axios.post(url, {
            "_token": getToken(),
            "arr": {
                "product_good_id":product_good_id,
                "product_good_num":product_good_num,
                "product_good_raid":product_good_raid,
                "product_good_number":product_good_number
            },
            "old_id":old_id,
            'status':"修改"
        }).then(function (response) {
            if(status){
                toastrMessage('success', response.data.info, '')
            }else{
                toastrMessage('success', response.data.info, 'static')
            }

        }).catch(function (err) {
            toastrMessage('error', '添加失败', '')
        });
    }
}
$(document).ready(function() {

    /*   增加产品  */
    $(".A_numbox .A_addNum").on("click",function(){
        var max = $(this).parent(".A_numbox").attr("maxNum");
        var NowNum = $(this).siblings(".good_num").val();

        if(NowNum == max){
            $(this).addClass("none");
            return false
        }else{
            var is_type=$(this).siblings(".good_num").attr('product-bianhao')
            var jj=1;
            var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.good_num').val();//cpu实际数量
            var neicun=$('.memory').val();//节点数量
            if(is_type=='D'){
                NowNum=parseInt(NowNum)+parseInt(cpunum);
            }else if(is_type=='B'){
                NowNum=parseInt(NowNum)+parseInt(neicun);
            }else{
                NowNum++;
            }
            if(is_type=='E'){
                checkRaids($(this),NowNum,1);
            }
            $(this).siblings(".good_num").val(NowNum);
            $(this).siblings(".A_delNum").removeClass("none");
        }
        // A_checkNum();
        A_proPriceTotal();
        zheng_JiXingHao_Create();
        if(is_type=='B'){
            memory('cpu');
            check_terrace();
            PlatformRadiator(NowNum);
            if(cpunum>2){
                $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_addNum').removeClass("none");
                $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_delNum').addClass("none");
            }else{
                $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_addNum').removeClass("none");
            }
            A_proPriceTotal();
        }
         edit_product_good($(this).parents(".A_num").siblings('.A_name').find('.select2'))
        if(NowNum == max){
            $(this).addClass("none");
            return false
        }
    });

    /*  减少产品  */
    $(".A_numbox .A_delNum").on("click",function(){
        if($(this).hasClass("none")){
            return false;
        }else{
            var jj=1;
            var max = $(this).parent(".A_numbox").attr("maxNum");
            var NowNum = $(this).siblings(".good_num").val();
            var is_type=$(this).siblings(".good_num").attr('product-bianhao');
            var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.good_num').val();//cpu实际数量
            var neicun=$('.memory').val();//节点数量
            if(is_type=='D'){
                jj=cpunum;
                NowNum=parseInt(NowNum)-parseInt(jj);
                if(NowNum<=0){
                    NowNum=cpunum;
                    $(this).addClass("none");
                }
            }else if(is_type=='B'){
                jj=neicun;
                 NowNum=parseInt(NowNum)-parseInt(jj);
                if(NowNum<=0){
                    NowNum=neicun;
                    $(this).addClass("none");
                }
            }else{
                NowNum--;
            }
            // console.log(NowNum);
            // return false
            if(is_type=='E'){
                checkRaids($(this),NowNum,1);
            }
            if(NowNum <= jj ){
                $(this).addClass("none");
                $(this).siblings(".A_addNum").removeClass("none");
                $(this).siblings(".good_num").val(NowNum);
            }else{
                $(this).siblings(".good_num").val(NowNum);
                $(this).removeClass("none");
            }
            // A_checkNum();
            zheng_JiXingHao_Create();
            A_proPriceTotal($(this).parent().parent(),NowNum);
            if(is_type=='B'){
                memory('cpu');
                check_terrace();
                PlatformRadiator(NowNum);
                if(cpunum>2){
                    $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_addNum').removeClass("none");
                    $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_delNum').addClass("none");
                }else{
                    $('.D').children('.A_num').children('.A_numbox').children('.good_num').siblings('.A_addNum').removeClass("none");
                }
                A_proPriceTotal();
            }
             edit_product_good($(this).parents(".A_num").siblings('.A_name').find('.select2'))
        }

        if(NowNum < max){
            $(this).siblings('.A_addNum').removeClass("none");
            return false;
        }
    });
//返回删除物料
    $(document).on('click','.all_delete',function () {
        var url=$(this).attr('data_url');
        var order_id=$(this).attr('order_id');
        axios.post(url, {
            "_token": getToken(),
            "_method": "delete",
            "id": order_id
        }) ;
    });
    //修改产品
    $(document).on('change','.product_select',function () {
       edit_product_good($(this))
    });
    //修改产品
    $(document).on('change','.good_num ',function () {
        edit_product_good($(this).parents('.A_num').siblings('.A_name').find('select'),true)
    });
    //修改raid
    $(document).on('change','.raid',function () {
        edit_product_good($(this).parent('.raids').siblings('.A_name').find('select'))
    });


});