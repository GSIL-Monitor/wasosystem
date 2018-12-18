/**
 * Created by john on 2016/7/8.
 */
//二维码
function qrcode() {
    $('#peizhi').html('');
    var qrcode = $('.codes').val();
    var options = {
        render: "canvas",
        color: "#000000",
        text: qrcode,
        size: parseInt(100, 10)
    };

    $('#peizhi').qrcode(options);
}
function getToken() {
    return $('meta[name="csrf-token"]').attr('content');
}
 	/*   自定义提示框  */
	function sysAlert(text){
		var timer 
		clearTimeout(timer);
		var text = text;
		var divs = "<div class='sysAlert' ><span>"+text+"</span></div>"
		$("body").append(divs);
	    timer = setTimeout(function(){
			$(".sysAlert").remove();
		},3500)
	}
	
 
$(document).ready(function(){
    $("a[name!='F_news']").attr("target","_top");
    var bodyWidth = $(window).width();
    qrcode();
    //  手机页面效果    开始
	
	

	



		



    /*  左部广告  */
    // function autobodyAD(){
    //     setTimeout("$('#bodyAD').addClass('bodyADShow')",2000);
    // }

    //  视频禁止右键    开始
    $(document).on("click","#bodyAD .close",function(){
        $("#bodyAD").removeClass();
    });

     /*  视频播放  */
     var obj = $("#video1");
     $(document).on("click",".videoBox",function(){
       // alert(obj.paused);
     });


    $(document).on("click",".videoBox .play",function(){
        // $(this).removeClass("play").addClass("pause");
         $(this).siblings(".playscreen").hide();
         $(this).hide();
        // $(this).parents(".videoBox").addClass("videoPlaying");
         $(this).siblings("video").trigger('play').attr("controls",true);
         $(this).siblings(".videoLinks").show();
     });
    // $(document).on("click",".videoBox .pause",function(){
    //     $(this).removeClass("pause").addClass("play");
    //     $(this).siblings(".playscreen").removeClass("hideScreen");
    //     $(this).parents(".videoBox").removeClass("videoPlaying");
    //     $(this).siblings("video").trigger("pause");
    // });



     $('video').bind('contextmenu',function() { return false; });

    if(bodyWidth>=900){
        // $('video').attr("autoplay",true);
        // autobodyAD();
    }



    /*  新年放假通知  */
    function autoNewYear(){
        setTimeout("$('#newyears').find('.wrap').addClass('showed')",1000);
        clearTimeout('autobodyAD');
    }
    autoNewYear();
    $(document).on("click","#newyears .closeThis",function(){
        if(bodyWidth>=900){
            $("#bodyAD").addClass("bodyADShow");
        }
        $("#newyears").hide();
        $("#newyears").find(".showed").removeClass('showed');
    });




    /*  关注我们按钮 */
    $(".P_foot_contact li img").toggle(
        function() {
            $(this).siblings('.f_links_box').fadeIn();
        },function() {
            $(this).siblings('.f_links_box').fadeOut();
       }
    );
    //  手机页面效果    结束


    /*  顶部广告按钮  */
    function addADName(){
        $("#headTopAd").addClass("headTopAdOpen");
        $('.Desinheader').css("top","30px");
        $('.DesinheadBg ').css("top","30px");
    }
    if(bodyWidth>900){
        setTimeout(function(){addADName();},1500);
    }
    $(document).on("click","#headTopAd .closeTopAd",function(){
        $("#headTopAd").removeClass("headTopAdOpen");
        $('.Desinheader').css("top","0");
        $('.DesinheadBg ').css("top","0");
    });

    /*  快捷键动画*/
    $(document).on("mouseover","#go li",function(){
       $(this).addClass("liHover").siblings("li").removeClass("liHover");
    });
    $(document).on("mouseleave","#go li",function(){
        $(this).removeClass("liHover");
    });


    /*  快捷键 显示标注 */
    $(document).scroll(function(){
        var LookHeight = $(window).height();
        var WindHeight = $(window).scrollTop();
       if(WindHeight > LookHeight){
           $('#go .top').addClass("goTopActive");
       }else{
           $('#go .top').removeClass("goTopActive");
       }
    });
    $("#go .top").click(function() {
        $("html,body").animate({scrollTop:0}, 500);
    });
      /*  回到顶部 */


    /*    搜索框变化  */
    $(document).on("click","#header .searchClose",function(){
        $(this).removeClass("searchClose").addClass("searchOpen");
        $("#header .links").addClass("hideLinks");
    });
    $(document).on("focus","#header .search_box .searchBorder input",function(){
       $(this).siblings("i").hide();
    });
    $(document).on("blur","#header .search_box .searchBorder input",function(){
        var val = $(this).val();
        if(val==""||val==" "){
            $(this).siblings("i").show();
        }
    });
    $(document).on("click","#header .searchOpen span",function(){
        var val = $(this).siblings("input").val();
        var reval = $(this).siblings("i").text();
        if(val==""||val==" "){
            val = reval;
        }
       location.href="/search?key="+val;
    });
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            $("#header .searchOpen span").trigger("click");
        }
    });


    $(document).bind("click",function(e){
        var target = $(e.target);
        if(target.closest(".search_box").length == 0 && target.closest(".main_point li").length == 0){
            $("#header .searchOpen").removeClass("searchOpen").addClass("searchClose");
            $("#header .links").removeClass("hideLinks");
        }
    });
    $(document).on("click","#header .closeSearch",function(){
        $(this).parents(".search_box").addClass('searchClose').removeClass("searchOpen");
        $("#header .links").removeClass("hideLinks");
    });


    /*  选项卡 */
    $('.tab_page li').click(function(){
        $(this).addClass('li2').siblings('li').removeClass('li2');
        var index = $('.tab_page li').index(this);
        $('.tab_box .tab').eq(index).show().siblings('.tab').hide();
    });


    /*  头部产品  展开 */
    $(document).on("mouseenter","#header .links .hide_pro",function(){
        if($(this).children(".choose_bg").hasClass("opend")){
            $(this).children('.choose_bg').show();
        }else{
            $(this).children('.choose_bg').slideDown();
        }
        $("#header .links .choose_bg").addClass("opend");
    });
    $(document).on("mouseleave","#header .links .hide_pro",function(){
        $(this).children(".choose_bg").hide();
    });
    $(document).on("mouseleave","#header .links .proLinks",function(){
        $("#header .links .choose_bg").removeClass("opend");
    });


    /*  头部产品 选择*/
    $(document).on("click","#header .headProType li",function(){
        var index= $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        $("#header .choose_bg dl").eq(index).addClass("activeDl").siblings("dl").removeClass("activeDl");
    });



    $('#header .user').mouseenter(function(){
         $('.user_box').slideDown(200);
   });
    $('#header .user').mouseleave(function(){
        $('.user_box').stop().slideUp(200);
    });
    /*  登录显示*/


    $('.head_control button').click(function(){
        $('.head_control .search').show();
        $('.menu ul').hide();
    });
    $('.head_control').click(function(e){
        $('.head_control .search').show();
        $('.menu ul').hide();
        $(document).one("click", function(){
            $(".head_control .search").hide();
            $('.menu ul').show();
        });
        e.stopPropagation();
    });


    /*  页脚隐藏展开  */
    var footW = $(window).width();
    if(footW<=900){
      $(document).on("click","#foot .f_tit",function(){
         if($(this).siblings('.f_hideUl').is(":visible")){
             $(this).children("i").removeClass("MoveI");
             $(this).siblings('.f_hideUl').slideUp();
         }else{
             $(this).children("i").addClass("MoveI");
             $(this).siblings('.f_hideUl').slideDown();
         }
      });
    }



    $('.buy_num .add').bind("click",function(){
        var val = $(this).siblings('input').val();
        val ++;
        $('.numbers').val(val);
        $('.remove').removeClass('no_change');
    });
    $('.buy_num .remove').bind("click",function(){
        var val = $(this).siblings('input').val();
        if(val==2){
            $(this).addClass('no_change');
        }
        if(val==1){
            return false;
        }else{
            val --;
            $('.numbers').val(val);
        }
    });
    /*  购买数量加减*/

    /*  品牌授权  */
    /*单数 margi-right*/
    var ComLi = $('.companies li');
    for(i=0; i<ComLi.length; i++){
        if(i%3 == 0){
            ComLi.eq(i).css("margin-right","2%");
        }
    }
    $('.companies li').bind("mouseenter",function(){
        $(this).find('.li_black').stop().animate({opacity:"0.8"},300);
        $(this).find('b').stop().animate({top:"50%",opacity:"1"},300);
        $(this).find('.left_line').stop().animate({left:"30%",opacity:"1"},300);
        $(this).find('.right_line').stop().animate({right:"30%",opacity:"1"},300);
    });
    $('.companies li').bind("mouseleave",function(){
        $(this).find('.li_black').stop().animate({opacity:"0"},300);
        $(this).find('b').stop().animate({top:"70%",opacity:"0"},300);
        $(this).find('.left_line').stop().animate({left:"20%",opacity:"0"},300);
        $(this).find('.right_line').stop().animate({right:"20%",opacity:"0"},300);
    });

    /*  仿select原理  */
    $('.select_box .selectOpen').each(function(){
        var select1 = $(this).next('.likeSelect').children("ul").children("li").eq(0).text();
        $(this).text(select1);
    });

    $(".selectOpen").bind("click",function(e) {
        var display = $(this).next(".likeSelect");
        var target = $(e.target);
        if (display.is(":hidden")) {
            $(this).next(".likeSelect").show();
            $(document).one("click", function(){
                $(".likeSelect").hide();
            });
            e.stopPropagation();
        } else {
            $(this).next(".likeSelect").hide();
        }
    });
    $(".likeSelect").on("click", function(e){
        e.stopPropagation();
    });
    $(".likeSelect li").bind("click",function(){
        var addrNow = $(this).text();
        $(this).parent('ul').parent('div').hide().siblings('p').text(addrNow);
    });



    /*   手机二维码 */
    var windH = $(window).height();    // 手机二维码大小
    var IconH = windH * 0.5 - 80;
    $(".phonePic").css("height",IconH);

    $(".headIcon i").on("click",function(){
       var iconTop = $("#iconbox").position().top;
      if(iconTop <= 0){
          $("#iconbox").stop().fadeIn(300).animate({top:windH*0.25-90},500);
          $("#head_black").fadeIn(300);
      }else{
          $("#iconbox").stop().fadeOut(300).animate({top:"-900px"},500);
          $("#head_black").fadeOut(300);
      }
    });
    $("#head_black").on("click",function(){
        $(this).fadeOut(300);
        $("#iconbox").stop().animate({top:"-900px"},500);
        $(".loginNow").stop().animate({top:"-900px"},300);
        $("#lookPic").hide();
        $('#softCopyRight').fadeOut(300);
    });

    //生成url二维码
    function qrcode() {
        var url=location.href;
        if (url.indexOf('localhost')>0){
            url = 'http://192.168.0.105'+url.substr(16);
        }else{
            url=location.href;
        }
        var options = {
            render: "canvas",
            color: "#000000",
             bgColor: "#ffffff",
             text: url,
             size: parseInt(90, 10)
        };
        $('#qrcode').qrcode(options);
    }







})
