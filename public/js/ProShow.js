/**
 * Created by john on 2016/7/8.
 */

$(document).ready(function(){

     /*  顶部固定  */
	 var ShowHeadTop = $("#ShowHead").offset().top;
	 var WindowW = $(window).width();
	 var PicW = $('.PicDiv .PicBox').width();
	 var PicH = $('.PicDiv .PicBox').height();
	 var PicLength = $('.PicDiv .PicUl li').length;


	/*  左右移动图片  */
	$('.PicDiv .PicUl li').css({"width":PicW,'height':PicH});



	function AddPicAtive(a,b){
		var oldNum = a.siblings('.PicBox').find(".active").index();
		var newNum = oldNum + b;
		if(newNum>=PicLength){newNum=0;}else if(newNum <= 0 ){newNum = PicLength-1;}
		a.siblings('.PicBox').find("li").eq(newNum).addClass('active').siblings().removeClass();
		a.parents('.PicDiv').find(".PicLines li").eq(newNum).addClass("active").siblings('li').removeClass();
	}

	$(document).on("click",".PicDiv .goRight",function(){
		AddPicAtive($(this),1);
	});

	$(document).on("click",".PicDiv .goLeft",function(){
		AddPicAtive($(this),-1);
	});

	$(document).on("click",".PicDiv .PicLines li",function(){
		var Picindex = $(this).index();
		$(this).addClass("active").siblings('li').removeClass();
		$(this).parents('.PicLines').siblings('.PicBox').find("li").eq(Picindex).addClass("active").siblings().removeClass();
	});



	 
	 /*  ====================     手机界面     =======================   */

	 var WindowH = $(window).height() * 0.6;
	 if(WindowW<900){
		$('.ProDivBg').css("height",WindowH); 
	 }
	 
	 $(document).on("click",".headMore",function(){
		 if($(this).hasClass("PChideActive")){
			 $(this).removeClass("PChideActive");
			 $("#ShowHead").slideUp();
		 }else{
			 $(this).addClass("PChideActive");
			 $("#ShowHead").slideDown();
		 }
	 });



	/*   左右滑动  */
	$(document).on("swipeleft",".PicDiv",function(e){
		var TotalPic = $(this).find(".PicLines li").length-1;
		var AcSitu = $(this).find(".PicLines .active").index();
		if(AcSitu<=0){
			AcSitu = TotalPic;
		}else{
			AcSitu--;
		}
		$(this).find(".PicLines li").eq(AcSitu).trigger("click");
	});
	$(document).on("swiperight",".PicDiv",function(e){
		var TotalPic = $(this).find(".PicLines li").length-1;
		var AcSitu = $(this).find(".PicLines .active").index();
		if(AcSitu>=TotalPic){
			AcSitu = 0;
		}else{
			AcSitu++;
		}
		$(this).find(".PicLines li").eq(AcSitu).trigger("click");
	});


	 
    /*  ====================     电脑界面     =======================   */	  
	 
	  /* 每个模板执行动画  */
	  $('.body .ProDiv').each(function(){
		  $(this).attr("dataTop",$(this).offset().top); 
	  });
	 
	 $(window).scroll(function(){
		  var WindScro = $(window).scrollTop();	
		  var DivTop  =0 ;

		  var WindH = $(window).height() * 0.3;
	      $('.body .ProDiv').each(function(){
			  if(WindowW<900){
			    DivTop = $(this).attr("dataTop")-WindH;
		      }else{
			    DivTop = $(this).attr("dataTop")-400;  
			  }

			  if(WindScro >= DivTop){
				  $(this).addClass('ActiveDiv');	
			  } 	 
		 }); 
	 });
	 	 
	 
	 $(window).scroll(function(){
	    // 滚动条距离顶部的距离 大于 200px时
		var WinT = $(window).scrollTop();
		var WinW = $(window).width();
		if( WinW >= 900){
			if( WinT >= ShowHeadTop){
			  $("#ShowHead").css("position","fixed"); 
			} else{
			  $("#ShowHead").css("position","static"); 
			}			
		}
	 });
	 
	 
	 
	 

	 
	 
	
	 
	 
	 
	 
	 
	  


});







