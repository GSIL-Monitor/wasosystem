/**
 * Created by john on 2016/7/8.
 */
/*    每个产品合计 */
function A_proPriceTotal(){
    var sum = 0;
    var dgs=$('input[name="dgshu"]').val();
    var chae=parseInt($('.chae').val());

    $(".pro_detail .detail_inner ul li").not(".tit").each(function(){
        var pri = parseInt($(this).children(".A_price").children('.pri').html());
        var num = parseInt($(this).children(".A_num").children('.A_numbox').children(".PJnum").val());
        num=num?num:1;
        var TotalPri = pri * num;
        $(this).children(".A_Total").children(".to").text(TotalPri);
        sum += TotalPri;
    });

    $('.A_allTotal b').text(parseInt(sum+chae));

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
//判断是否有平台
//判断是否有平台
function check_pingtai() {
    var pingtai=0;
    $.each($(".orderTable ul li:not('.tit')"),function () {
        if($(this).attr('class')=='A'){pingtai++;}
    });
    if(pingtai==0){
        sanreqis();
    }
}
/*  默认检查数量 */
function A_checkNum(){
    $(".pro_detail .detail_inner .A_numbox").each(function(){
        var max = $(this).attr("maxNum");
        var num=1;
        var is_type=$(this).children().siblings(".A_pro_num").data('content');
        var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
        var neicun=$('.neicun').val();//节点数量
        if(is_type=='D'){num=cpunum;}
        if(is_type=='B'){num=neicun;}
        var val=$(this).children('.PJnum').val();
        if(is_type=='E'){ raids($(this).children('.PJnum'),val,2)}
        if($(this).children(".PJnum").val()==max){
            $(this).children(".A_addNum").addClass("none");
        }else{
            $(this).children("button").removeClass("none");
        }if($(this).children(".PJnum ").val()==num){
            $(this).children(".A_delNum").addClass("none");
        }else{
            $(this).children("button").removeClass("none");
        }
    });
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
       $.get(pingtaisanreurl,{"wliaoid":pingtaiid,"danjia":$pingtaiprice},function (data) {
           
       });

        $('.A').find(".pri").text($pingtaiprice);
        $('.A').find(".to").text(pingtainum*$pingtaiprice);
    }
}

$(document).ready(function(){
    check_pingtai();
    A_checkNum();
    A_proPriceTotal();
    if($('.compare_list li').length>0){
        $("#CompareBox").show();
    }
    /*  手机端效果   开始  */



    //筛选条件
    var Wheight =$(".body").height()-40;
    var ConHeight = Wheight / 4 * 3;
    var Wwidth =$(window).width() ;
    if(Wwidth<900){
        $("#condition").css({"width":Wwidth,"height":ConHeight});
        $(".choosed").css({"height":Wheight/4,"padding":"20px 10px","width":Wwidth-20,"z-index":"992"});
    }

    $('.P_pro_condition .P_condition').bind("click",function(){
        $("#con_sit").val("1");
        $('.P_con_box').animate({left:"0"},200);
        $('#condition').animate({left:"0"},200);
        $('.choosed').animate({left:"0"},200);
    });
    $('.P_con_box .P_close').bind("click",function(){
        $("#con_sit").val("0");
        $('.P_con_box').animate({left:"100%"},200);
        $('#condition').animate({left:"100%"},200);
        $('.choosed').animate({left:"100%"},200);
    });
    $('.P_con_box .P_sure').bind("click",function(){
        $("#con_sit").val("0");
        $('.P_con_box').animate({left:"100%"},200);
        $('#condition').animate({left:"100%"},200);
        $('.choosed').animate({left:"100%"},200);
    });


    function checkSit(){
        var con_sit = $("#con_sit").val();
        var Wwidth =$(window).width() ;
        if(Wwidth>900){
            if(con_sit == '0'){
                $('.hide_condition').css("display","none");
            }else if(con_sit == '1'){
                $('.hide_condition').css("display","block");
            }
        }else{
            if(con_sit == '0'){
              $('#condition').css("left","100%");
           }else if(con_sit == "1"){
                $('#condition').css("left","0");
            }
        }
    }







    /*    左部类别  滚动固定  */
    $(window).scroll(function(){
        if($(window).scrollTop() >= 140){
            var Width = $('.ProType').width();
            $(".ProType").css({width:""+Width+"",position:"fixed"});
        } else{
            $(".ProType").css({width:"20%",position:"relative"});
        }
    });






    /*  产品详情 参数偶数变色  */
    $('.detail_info dl dd:even').css("background","#f7f7f7");

    /*  参数显示隐藏   侧方版本*/
    $('.condition_box dl dt img').toggle(function(){
        $(this).addClass("condition_close");
        $(this).parent("dt").siblings(".condition_detail").slideUp(200);
    },function(){
        $(this).removeClass().addClass("condition_open");
        $(this).parent("dt").siblings(".condition_detail").slideDown(200);
    });

    $('.P_condition select').focus(function(){
        $(this).next('img').rotate({animateTo:180});
    });
    $('.P_condition select').blur(function(){
        $(this).next('img').rotate({animateTo:0});
    });
    /*   仿select箭头  */






    /*  弹出框默认设置 */
    var WindW = $(window).width() * 0.8;
    var WindH = $(window).height() * 0.9;
    var UlLenght = $(".scroll_pic li");
    for(var i=0; i<UlLenght.length; i++){
        $("#lookPic .points").append("<li></li>");
    }
    $("#lookPic .points li").eq(0).addClass("point_active");
    $("a").attr('data-ajax',false);
    /*  添加锚点 */







    /*   =========   立即购买  弹出部分  ===========   */





    /*   整机编辑  */
    $(".editDetail").on("click",function(){
        var Width = $(window).width();
        var Height = $(window).height();
        $('.detail_inner').css('height',Height*0.5);
        if(Width<900){
            $(".pro_detail").css({"max-height":"100%","height":"100%"});
            $(".pro_detail").stop().animate({top:0},300);
        }else{
            $(".pro_detail").stop().animate({top:"10%"},300);
        }
        $("#Pic_black").css("z-index",9991).fadeIn(300);
        A_checkNum();
        A_proPriceTotal();
          zheng_JiXingHao_Create();
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
        $("#Pic_black").css("z-index",9991).fadeIn(300);
    });


    $(".DoneControl span").on("click",function(){
        $("#Pic_black").fadeOut(300);
        $(".pro_detail").stop().animate({top:"-900px"},300,function(){
            $(this).css({"max-height":"70%","height":"auto"});
        });
        $(".Mydetail").stop().animate({top:"-900px"},300,function(){
            $(this).css({"max_height":"70%","height":"auto"});
        });
    });

    /*   增加产品  */
    $(".A_numbox .A_addNum").on("click",function(){
        var max = $(this).parent(".A_numbox").attr("maxNum");
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
        A_checkNum();
        A_proPriceTotal();
          zheng_JiXingHao_Create();
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
    });

    /*  减少产品  */
    $(".A_numbox .A_delNum").on("click",function(){
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
            A_checkNum();
              zheng_JiXingHao_Create();
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
        }
    });
  function neicuns() {
          var maxnum=0;
          var neicun=$('.neicun').val();//节点数量
          var bcs=$('.neicun').data('content');//节点CPU并存数
          var ccs=$('.neicun').data('action');//节点内存插槽数
          var jb=$('.neicun').data('id');//内存是否减半
          var cpunum=$('.B').children('.A_num').children('.A_numbox').children('.PJnum').val();//cpu实际数量
          if(jb==1){
              maxnum= ((ccs/bcs)*cpunum)*neicun;
              $('.D').children('.A_num').children('.A_numbox').attr('maxnum',maxnum);
              $('.D').children('.A_num').children('.A_numbox').children('.PJnum').val(cpunum);//cpu实际数量
              $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_delNum').addClass("none");
          }else{
              maxnum=ccs;
              $('.D').children('.A_num').children('.A_numbox').attr('maxnum',maxnum);
              $('.D').children('.A_num').children('.A_numbox').children('.PJnum').val(cpunum);//cpu实际数量
              $('.D').children('.A_num').children('.A_numbox').children('.PJnum').siblings('.A_delNum').addClass("none");
          }
      }


});











