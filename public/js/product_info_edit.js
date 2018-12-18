/**
 * Created by john on 2016/7/8.
 */
//整机型号生成
//整机型号生成

function zheng_JiXingHao_Create() {
    var str='';
    var str1='';
    var pingtai =$("input[data-id='pingtai']");
    var cpu =$("input[data-id='cpu']");
    var zhuban =$("input[data-id='zhuban']");
    var neicun =$("input[data-id='neicun']");
    var pingpan =$("input[data-id='pingpan']");
    var xianka =$("input[data-id='xianka']");
    var zhenlie =$("input[data-id='zhenlie']");
    var sanre =$("input[data-id='sanre']");
    var wangka =$("input[data-id='wangka']");
    var zhuanyong =$("input[data-id='zhuanyong']");
    var jixiang =$("input[data-id='jixiang']");
    var dianyuan =$("input[data-id='dianyuan']");
    var qita =$("input[data-id='qita']");
    var wangka_jiekou,n5,n6=0,n7=0,n8=0,xiankanum=0,xiankanum1=0,W='',W1='';
    $.each($('.jianma'),function () {
        var jianma=$(this).val();
        var type=$(this).data('id');
        if (jianma && type){
            str=str+'|'+ jianma+'|'+type+';';
        }
    });
    $.each($("input[data-id='wangka']"),function () {
        var value=$(this).val();
        var value1=$(this).next().val();
        W=value.substr(0,1);
        W1=value.substr(1,1);
        if(W=='L') {
            n6 += parseInt(W1) * value1;
        }
        if(W=='T') {
            n7 += parseInt(W1) * value1;
        }
        if(W=='G') {
            n8 += parseInt(W1) * value1;
        }

    });
    $.each(xianka.next(),function (i) {
        var val=parseInt($(this).val());
        xiankanum1+=val;
    });
    if(zhuban.next().val()){
        var zhubannum=zhuban.next().val();
    }
    if (xiankanum1<=1){xiankanum=0;}else{xiankanum=xiankanum;}
    if (zhubannum<=1){zhubannum=0;}else{zhubannum=zhubannum;}
    if (cpu.val()){
        var cpu_jianma=cpu.val();
    }

    if(xianka.val()){
        var xianka_jianma=xianka.val().split(',');
    }
    if(zhuanyong.data('action')){
        var zhuanyong_type=zhuanyong.data('action');
        var zhuanyong_jianma=zhuanyong.val();
    }
    var num=0,num1='',zl='';
    //如果有平台的情况
    if(str.indexOf('pingtai')!=-1){

        if (pingtai.val()){
            var pingtai_arr=pingtai.val().split(',');//机箱简码2,3,5,6
        }

        if(pingtai_arr[4]<=1){
            pingtai_arr[4]=0;
        }
        if(pingtai_arr.length==8){
            var ping7='-'+pingtai_arr[7];
        }else{
            var ping7='';
        }
        if(zhenlie.val()==undefined){zl='';}else{zl=zhenlie.val();}
        var Z=pingtai_arr[3].substr(0,1),Z1=pingtai_arr[3].substr(1,1);

        num1=nums(n6,n7,n8,Z,Z1,num1);

        //有平台专用卡情况
        if (str.indexOf('zhuanyong')!=-1 && zhuanyong_type=='GPU卡' && str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1 ){
            str1='N'+''+zhuanyong_jianma+''+pingtai_arr[1]+''+pingtai_arr[5]+''+pingtai_arr[2]+'-'+''+cpu_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);

            return false;
        }
        //有平台显卡情况
        if (str.indexOf('xianka')!=-1 && str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1 ){
            var pingTaiOrXianka='';
            if(pingtai_arr[0]=='G'){
                pingTaiOrXianka=pingtai_arr[0];
            }else{
                if(xiankanum1==1){pingTaiOrXianka=xianka_jianma[0];xiankanum1=0;}else{

                    if(xiankanum1>=1){
                        pingTaiOrXianka='W';
                    }else{
                        pingTaiOrXianka=pingtai_arr[0];
                    }
                }
            }
            str1='N'+''+pingTaiOrXianka+''+pingtai_arr[1]+''+xiankanum1+''+pingtai_arr[2]+'-'+''+cpu_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);

            return false;
        }
        //有平台情况
        if (str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1){
            str1='N'+''+pingtai_arr[0]+''+pingtai_arr[1]+''+pingtai_arr[4]+''+pingtai_arr[2]+'-'+''+cpu_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);
            //  alert(str1 +"e");

            return false;
        }

    }else{

        if (jixiang.val()){
            var jixiang_arr=jixiang.val().split(',');//机箱简码2,3,5,6
        }
        if (zhuban.val()){
            var zhuban_arr=zhuban.val().split(',');//机箱简码2,3,5,6
        }
        if(zhuban_arr.length==3){
            var zhuban2='-'+zhuban_arr[2];
        }else{
            var zhuban2='';
        }
        if(jixiang_arr['3']==undefined){num=zhubannum>1?zhubannum:0;}else{num=str.indexOf('zhuanyong')!=-1?jixiang_arr[3]:zhubannum>1?zhubannum:0;}

        if(zhenlie.val()==undefined){zl='';}else{zl=zhenlie.val();}
        var Z=zhuban_arr[1].substr(0,1),Z1=zhuban_arr[1].substr(1,1);
        num1=nums(n6,n7,n8,Z,Z1,num1);

        n5=jixiang_arr[2].substr(0,1)+''+(eval((parseInt(jixiang_arr[2].substr(1,1))+parseInt(zhuban_arr[0]))));
        //有专用卡情况
        if (str.indexOf('zhuanyong')!=-1 && zhuanyong_type=='GPU卡' && str.indexOf('zhuban')!=-1){
            str1='N'+''+zhuanyong_jianma+''+jixiang_arr[1]+''+num+''+n5+'-'+''+cpu_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            return false;
        }
        //有显卡情况
        if (str.indexOf('xianka')!=-1 && str.indexOf('zhuban')!=-1 ){
            var zhuBanOrXianka='';
            if(jixiang_arr[0]=='G'){
                zhuBanOrXianka=jixiang_arr[0];
            }else{
                if(xiankanum1==1){zhuBanOrXianka=xianka_jianma[0];xiankanum1=0;}else{
                    if(xiankanum1>=1){
                        zhuBanOrXianka='W';
                    }else{
                        zhuBanOrXianka=jixiang_arr[0];
                    }

                }
            }
            str1='N'+''+zhuBanOrXianka+''+jixiang_arr[1]+''+xiankanum1+''+n5+'-'+''+cpu_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            return false;
        }
        //基本情况
        if (str.indexOf('jixiang')!=-1 && str.indexOf('zhuban')!=-1){
            if(zhubannum>=2){ $two='M';   }else{$two=jixiang_arr[0];}
            str1='N'+''+$two+''+jixiang_arr[1]+''+num+''+n5+'-'+''+cpu_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            return false;
        }
    }
    return true;
}



function nums(n6,n7,n8,Z,Z1,num1) {
    if(n6>0 && Z=='L'){
        num1=parseInt(n6)+parseInt(Z1);
        num1=Z+num1;
    }else {
        if (n6 > 0) {
            num1 = 'L' + n6;
        } else {
            if (n7 > 0 && Z == 'T') {
                num1 = parseInt(n7) + parseInt(Z1);
                num1 = Z + num1;
            } else {
                if (n7 > 0) {
                    num1 = 'T' + n7;
                } else {
                    if (n8 > 0 && Z == 'G') {
                        num1 = parseInt(n8) + parseInt(Z1);
                        num1 = Z + num1;
                    } else {
                        if (n8 > 0) {
                            num1 = 'G' + n8;
                        } else {
                            num1 = 'G' + Z1;
                        }
                    }
                }
            }
        }
    }
    return num1;
}
function shejishi_JiXingHao_Create() {
    var str='';
    var str1='';
    var pingtai =$("input[data-id='pingtai']");
    var cpu =$("input[data-id='cpu']");
    var zhuban =$("input[data-id='zhuban']");
    var neicun =$("input[data-id='neicun']");
    var pingpan =$("input[data-id='pingpan']");
    var xianka =$("input[data-id='xianka']");
    var zhenlie =$("input[data-id='zhenlie']");
    var sanre =$("input[data-id='sanre']");
    var wangka =$("input[data-id='wangka']");
    var zhuanyong =$("input[data-id='zhuanyong']");
    var jixiang =$("input[data-id='jixiang']");
    var dianyuan =$("input[data-id='dianyuan']");
    var qita =$("input[data-id='qita']");
    var wangka_jiekou,n5,n6=0,n7=0,n8=0,xiankanum=0,xiankanum1=0,W='',W1='';
    $.each($('.jianma'),function () {
        var jianma=$(this).val();
        var type=$(this).data('id');
        if (jianma && type){
            str=str+'|'+ jianma+'|'+type+';';
        }
    });
    $.each($("input[data-id='wangka']"),function () {
        var value=$(this).val();
        var value1=$(this).next().val();
        W=value.substr(0,1);
        W1=value.substr(1,1);
        if(W=='L') {
            n6 += parseInt(W1) * value1;
        }
        if(W=='T') {
            n7 += parseInt(W1) * value1;
        }
        if(W=='G') {
            n8 += parseInt(W1) * value1;
        }
    });

    $.each(xianka.next(),function (i) {
        var val=parseInt($(this).val());
        xiankanum1+=val;
    });
    if(zhuban.next().val()){
        var zhubannum=zhuban.next().val();
    }
    if (xiankanum1<=1){xiankanum=0;}else{xiankanum=xiankanum;}
    if (zhubannum<=1){zhubannum=0;}else{zhubannum=zhubannum;}
    if (cpu.val()){
        var cpu_jianma=cpu.val();
    }

    if(xianka.val()){
        var xianka_jianma=xianka.val().split(',');
        var xiankanum=xianka.next().val();
    }
    if(neicun.val()){
        var neicunnum=neicun.next().val();
        var neicun_jianma=parseInt(neicun.val()*neicunnum);
    }
    if(zhuanyong.data('action')){
        var zhuanyong_type=zhuanyong.data('action');
        var zhuanyong_jianma=zhuanyong.val();
        var zhuanyongnum=zhuanyong.next().val();
    }
    var num=0,num1='',zl='';
    //如果有平台的情况
    if(str.indexOf('pingtai')!=-1){
        if (pingtai.val()){
            var pingtai_arr=pingtai.val().split(',');//机箱简码2,3,5,6
        }
        if(pingtai_arr[4]<=1){
            pingtai_arr[4]=0;
        }
        if(pingtai_arr.length==8){
            var ping7='-'+pingtai_arr[7];
        }else{
            var ping7='';
        }
        if(zhenlie.val()==undefined){zl='';}else{zl=zhenlie.val();}
        var Z=pingtai_arr[3].substr(0,1),Z1=pingtai_arr[3].substr(1,1);
        num1=nums(n6,n7,n8,Z,Z1,num1);
        //有平台专用卡情况
        if (str.indexOf('zhuanyong')!=-1 && zhuanyong_type=='GPU卡' && str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1 ){
            str1='N'+''+pingtai_arr[0]+''+pingtai_arr[1]+''+zhuanyongnum+'3'+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);
            // alert(str1 +"a");

            return false;
        }
        //有平台显卡情况
        if (str.indexOf('xianka')!=-1 && str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1 ){

            str1='N'+''+pingtai_arr[0]+''+pingtai_arr[1]+''+xiankanum+''+xianka_jianma[1]+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);
            // alert(str1 +"b");

            return false;
        }
        //有平台情况
        if (str.indexOf('pingtai')!=-1 && str.indexOf('cpu')!=-1){
            str1='N'+''+pingtai_arr[0]+''+pingtai_arr[1]+''+xiankanum+'0'+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+pingtai_arr[6]+ping7;
            $(".name").val(str1);
            //  alert(str1 +"e");

            return false;
        }
    }else{
        var num=0,num1='',zl='';
        if (jixiang.val()){
            var jixiang_arr=jixiang.val().split(',');//机箱简码2,3,5,6
        }
        if (zhuban.val()){
            var zhuban_arr=zhuban.val().split(',');//机箱简码2,3,5,6
        }
        if(zhuban_arr.length==3){
            var zhuban2='-'+zhuban_arr[2];
        }else{
            var zhuban2='';
        }
        if(jixiang_arr['3']==undefined){num=zhubannum>1?zhubannum:0;}else{num=str.indexOf('zhuanyong')!=-1?jixiang_arr[3]:zhubannum>1?zhubannum:0;}

        if(zhenlie.val()==undefined){zl='';}else{zl=zhenlie.val();}
        var Z=zhuban_arr[1].substr(0,1),Z1=zhuban_arr[1].substr(1,1);
        num1=nums(n6,n7,n8,Z,Z1,num1);
        n5=jixiang_arr[2].substr(0,1)+''+(eval((parseInt(jixiang_arr[2].substr(1,1))+parseInt(zhuban_arr[0]))));
        //有专用卡情况
        if (str.indexOf('zhuanyong')!=-1 && zhuanyong_type=='GPU卡' && str.indexOf('zhuban')!=-1){
            str1='N'+''+jixiang_arr[0]+jixiang_arr[1]+''+zhuanyongnum+'3'+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            //alert(str1 +"c");
            // alert(3);
            return false;
        }
        //有显卡情况
        if (str.indexOf('xianka')!=-1 && str.indexOf('zhuban')!=-1 ){
            var zhuBanOrXianka='';
            str1='N'+''+jixiang_arr[0]+''+jixiang_arr[1]+''+xiankanum+''+xianka_jianma[1]+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            //  alert(str1 +"d");
            // alert(4);
            return false;
        }
        //基本情况
        if (str.indexOf('jixiang')!=-1 && str.indexOf('zhuban')!=-1){
            str1='N'+''+jixiang_arr[0]+''+jixiang_arr[1]+'00'+cpu_jianma.substr(1,1)+'-'+''+neicun_jianma+''+num1+zl+dianyuan.val()+zhuban2;
            $(".name").val(str1);
            return false;
        }
    }
    return true;
}
//二维码
function qrcode() {
    var qrcode = $('.zhengji_peizhi').val();
    var options = {
        render: "canvas",
        color: "#000000",
        text: qrcode,
        size: parseInt(100, 10),
    };
    $('#peizhi').qrcode(options);
}
//生成配置
function zheng_JiDaiMa_Create() {
    var status=$('.status').val();
    var str='',str1='',str2='';
    $.each($('.PJnum'),function () {
        var num=$(this).val();
        var wuliaoid=$(this).attr('data-id');
        var type=$(this).attr('data-content');
        if(wuliaoid.length== 1){str1='00'};
        (num.length == 1)?str2='00':'';
        (wuliaoid.length == 2)?str1='0':'';
        (num.length == 2)?str2='0':'';
        (wuliaoid.length == 3)?str1='':'';
        (num.length == 3)?str2='':'';
        str += type+''+str1+''+wuliaoid+''+str2+''+num;
    });
    $(".zhengji_peizhi").val(status+''+str)
    return true;
}
//散热器 CPU的实际数量 就是散热器的实际数量
function sanreqis() {
    var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
    $('.L').children('.A_num').children('.A_numbox').children('.PJnum').val(cpunum);
}
function raids(raid,val,type) {
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
//参数改变
function canshu(changeNum) {
    var cpid =changeNum.parents('.A_num').siblings('.A_easy_name').children('select').val();
    var num=changeNum.siblings('.PJnum').val();
    var id=changeNum.siblings('.PJnum').attr('name');
    var type=changeNum.parents('.A_num').siblings('.A_easy_name').children('select').data('content');
    var raid=changeNum.parents('.A_num').siblings('.A_radius').children('select:visible').val();
    var classs=changeNum.parents('li').attr('class');
    // return false;
    if(cpid!=''){
        $.post(get_canshu_url,{type:type,cpid:cpid,num:num,wliaoid:id,raid:raid,edit:'edit'},function(data){
            if(data.sta=='ok'){
                $(".cs"+data.wlid).text(data.canshu);
            }else{
                alert("添加速度太快 !");
            }
        });
    }
}
function A_proPriceTotal(){
    var sum = 0;

    $(".detail_inner ul li").not(".tit").each(function(){
        var pri = $(this).children(".A_price").children('.pri').html();
        var num = $(this).children(".A_num").children('.A_numbox').children(".PJnum").val();
        num=num?num:1;
        var TotalPri = pri * num;
        $(this).children(".A_Total").children(".to").text(TotalPri);
        sum += TotalPri;
    });
    var chae=parseInt($('.chae').val())
    $('.price').children('b').text(sum+chae);
    // $('.cb').val(sum);
    // $('.price1').val(sum);
}

function neicuns() {
    var maxnum=0;
    var neicun=$('.neicun').val();//节点数量
    var bcs=$('.neicun').data('content');//节点CPU并存数
    var ccs=$('.neicun').data('action');//节点内存插槽数
    var jb=$('.neicun').data('id');//内存是否减半
    var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
    if(jb==1){
        maxnum= ((ccs/bcs)*cpunum)*neicun;
    }else{
        maxnum=ccs;
    }
    canshu( $('.D').children('.A_num').children('.A_numbox').children('button'));
    $('.D').children('.A_num').children('.A_numbox').attr('maxnum',maxnum);
    $('.D').children('.A_num').children('.A_numbox').children('.PJnum').val(cpunum);//cpu实际数量
}

//判断是否有平台
function check_pingtai() {
    // var pingtai=0;
    // $.each($(".detail_inner ul li"),function () {
    //     if($(this).attr('class')=='A'){pingtai++;}
    //
    // });
    // if(pingtai==0) {
    //     sanreqis();
    // }else{
    //     $('.A').hide();
    // }
    var pingtai=0;
    $.each($(".orderTable ul li:not('.tit')"),function () {
        if($(this).attr('class')=='A'){pingtai++;}
    });
    if(pingtai==0){
        sanreqis();
    }
}


function pingtaisansre($cpunum) {
    var pingtaisanre=$('.pingtaisanre').val();
    var pingtaidanjia=parseInt($('.A').find(".pri").attr('data-id'));
    var pingtainum=parseInt($('.A').find(".PJnum ").val());
    var pingtaiid=parseInt($('.A').find(".PJnum ").attr('name'));
    if(pingtaisanre!=undefined){
        if($cpunum>1){
            $pingtaiprice=(pingtaidanjia+($cpunum*pingtaisanre))-pingtaisanre;
        }else{
            $pingtaiprice=pingtaidanjia;
        }
        $.get(pingtaisanreurl,{"wliaoid":pingtaiid,"danjia":$pingtaiprice},function (data) {});
        $('.A').find(".pri").text($pingtaiprice);
        $('.A').find(".to").text(pingtainum*$pingtaiprice);
    }
}
/*  默认检查数量 */
function A_checkNum(){
    $(".detail_inner li").each(function(){
        var max = parseInt($(this).find(".A_numbox").attr("maxnum"));
        var num=1;
        var is_type=$(this).find(".A_numbox").children().siblings(".A_pro_num").data('content');
        var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
        var neicun=$('.neicun').val();//节点数量
        var val=parseInt($(this).find(".A_numbox").children('.PJnum').val());
        if(is_type=='D'){
            num = cpunum;
        }
        if(is_type=='B'){
            num = neicun;
        }
        if(is_type=='E'){ raids($(this).find(".A_numbox").children('.PJnum'),val,2)}
        if(val < max){
            $(this).find(".A_numbox").children(".A_addNum").removeClass("none");
        }else{
            $(this).find(".A_numbox").children(".A_addNum").addClass("none");
        }
        if(val <= num){
            $(this).find(".A_numbox").children(".A_delNum").addClass("none");
        }else{
            $(this).find(".A_numbox").children(".A_delNum").removeClass("none");
        }
    });
}

$(document).ready(function(){

    /*   =========   立即购买  弹出部分  ===========   */
    /*   增加产品  */

    $(".A_numbox .A_addNum").on("click",function(){
        var status=$('.status').val();
        var max = $(this).parent(".A_numbox").attr("maxnum");
        var NowNum = $(this).siblings(".A_pro_num").val();
        if(NowNum == max){
            $(this).addClass("none");
            return false
        }else{
            var is_type=$(this).siblings(".A_pro_num").data('content')
            var jj=1;
            var is_type=$(this).siblings(".A_pro_num").data('content');
            var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
            var neicun=$('.neicun').val();//节点数量
            if(is_type=='D'){
                NowNum=parseInt(NowNum)+parseInt(cpunum);
            }else if(is_type=='B'){
                NowNum=parseInt(NowNum)+parseInt(neicun);
            }else{
                NowNum++;
            }
            if(is_type=='E'){
                raids($(this),NowNum,1);
            }
            $(this).siblings(".A_pro_num").val(NowNum);
            $(this).siblings(".A_delNum").removeClass("none");
        }
       zheng_JiDaiMa_Create();
        if(is_type=='B'){
            neicuns();
            check_pingtai()
            pingtaisansre(NowNum);
            if(cpunum>2){
               $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_addNum').removeClass("none");
               $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_delNum').addClass("none");
            }else{
               $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_addNum').removeClass("none");
            }
           A_proPriceTotal();
        }
        if(is_type=='B'||is_type=='D'||is_type=='E'){
            canshu($(this));
        }
        if(status==4){
            shejishi_JiXingHao_Create();
        }else{
            zheng_JiXingHao_Create();
        }
        A_checkNum();
        A_proPriceTotal();
    });

    /*  减少产品  */
    $(".A_numbox .A_delNum").on("click",function(){
        var status=$('.status').val();
        if($(this).hasClass("none")){
            return false;
        }else{
            var jj=1;
            var NowNum = $(this).siblings(".A_pro_num").val();
            var is_type=$(this).siblings(".A_pro_num").data('content');
            var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
            var neicun=$('.neicun').val();//节点数量
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
            if(is_type=='E'){
                raids($(this),NowNum,1);
            }
            if(NowNum <= jj ){
                $(this).addClass("none");
                $(this).siblings(".A_addNum").removeClass("none");
                $(this).siblings(".A_pro_num").val(NowNum);
            }else{
                $(this).siblings(".A_pro_num").val(NowNum);
                $(this).removeClass("none");
            }
            zheng_JiDaiMa_Create();
            A_checkNum();
            A_proPriceTotal($(this).parent().parent(),NowNum);
            if(is_type=='B'){
                neicuns();
                check_pingtai();
                pingtaisansre(NowNum);
                if(cpunum>2){
                    $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_addNum').removeClass("none");
                    $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_delNum').addClass("none");
                }else{
                    $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_addNum').removeClass("none");
                }
                A_proPriceTotal();
            }
            if(is_type=='B'||is_type=='D'||is_type=='E'){
                canshu($(this));
            }
        }
        if(status==4){
            shejishi_JiXingHao_Create();
        }else{
            zheng_JiXingHao_Create();
        }

    });
    //修改
    $(document).on("change", ".canshu", function () {
        var cpid = $(this).val();
        var status=$('.status').val();
        var num=$(this).parent().siblings('.A_num').children('.A_numbox').children('.PJnum').val();
        var id=$(this).attr('id');
        var type=$(this).data('content');
        var raid=$(this).parent('.A_easy_name').siblings('.A_radius').children('select:visible').val();
        if(cpid!=''){
            $.post(Add_wuliao_type_url,{type:type,cpid:cpid,num:num,wliaoid:id,raid:raid,edits:'edits'},function(data){
                if(data.sta=='ok'){
                    $(".s"+data.wlid).text(data.danjia);
                    $(".n"+data.wlid).attr('data-id',data.cpid);
                    $(".n"+data.wlid).attr('data-content',data.bianhao);
                    $(".n"+data.wlid).attr('data-content',data.bianhao);
                    $(".cs"+data.wlid).text(data.canshu);
                    $(".j"+data.wlid).val(data.jianma);
                    $(".j"+data.wlid).attr('data-action',data.jiagou);
                    A_proPriceTotal();
                    if(status==4){
                        shejishi_JiXingHao_Create();
                    }else{
                        zheng_JiXingHao_Create();
                    }
                }else{
                    alert("已有该物料,请修改数量!");
                }
            });
        }
    });
    //修改raid
    $(document).on("change", ".raid", function () {
        var raid = $(this).val();
        var num=$(this).parent().siblings('.A_num').children('.A_numbox').children('.PJnum').val();
        var id=$(this).parent().siblings('.A_num').children('.A_numbox').children('.PJnum').attr('name');
        var type=$(this).parent().siblings('.A_easy_name').children('select').data('content');
        var cpid=$(this).parent().siblings('.A_easy_name').children('select').val();
        if(cpid!=''){
            $.post(get_canshu_url,{type:type,cpid:cpid,num:num,wliaoid:id,raid:raid,edit:'edit'},function(data){
                if(data.sta=='ok'){
                    $(".cs"+data.wlid).text(data.canshu);
                }else{
                    alert("已有该物料,请修改数量!");
                }
            });
        }
    });

    check_pingtai();
    A_checkNum();
    A_proPriceTotal();

});











