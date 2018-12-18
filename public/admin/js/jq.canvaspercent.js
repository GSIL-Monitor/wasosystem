/*
 * canvaspercent 0.1
 * Copyright：HeavyShell
 * Date: 2016-06-27
 * 利用canvas绘图实现百分比percent圆饼图
 */
(function($){
    $.fn.drawCanvasPercent = function(options){
        //各种属性、参数
        var defaults = {
            type:1, //类型默认1，有[1,2,3]
            dw:'rem',  //判断是单位是rem还是px
            cir_r:1,  //圆饼的直径
            cir_color:'#0e9cfa', //圆饼的占比颜色
            cir_color_op:'#e0ebf4', //圆饼的占比颜色
            line_w:0.16,  //圆饼的线条宽度
            fill_color:"#fff"  //圆饼的中间区域填充颜色
        }
        var options = $.extend(defaults, options);
        this.each(function(){
            //插件实现代码
            var cur_obj=$(this);
            var width = $(window).width();
            console.log(width)
            if(options.dw=="rem"){
                if(width < 900){
                    var cur_cir_r=options.cir_r*(window.screen.width/5);
                    var cur_line_w=options.line_w*(window.screen.width/5);
                }else{
                    var cur_cir_r=options.cir_r*(window.screen.width/15);
                    var cur_line_w=options.line_w*(window.screen.width/15);
                }
            }else{
                var cur_cir_r=options.cir_r / 3 * 2;
                var cur_line_w=options.line_w / 3 * 2;
            }
            var cur_type=options.type;
            var cur_cir_color=options.cir_color;
            var cur_cir_color_op=options.cir_color_op;
            var cur_fill_color=options.fill_color;
            var percent=cur_obj.attr('data-percent');
            cur_obj.attr({'width':cur_cir_r,'height':cur_cir_r});
            cur_obj.css({'border-radius':"50%",'background':cur_cir_color_op});
            if(cur_obj[0].getContext){

                if(cur_type==2){
                    //无填充颜色，且线条宽度等于直径
                    cur_line_w=cur_cir_r;
                }else if(cur_type==3){
                    //无填充颜色
                }else{
                    //有填充颜色
                    var ctx2 = cur_obj[0].getContext("2d");
                    ctx2.fillStyle = cur_fill_color;
                    ctx2.arc(cur_cir_r/2, cur_cir_r/2, cur_cir_r/2-cur_line_w/2, 0, Math.PI*2, false);
                    ctx2.fill();
                }

                var ctx = cur_obj[0].getContext("2d");
                ctx.beginPath();
                ctx.strokeStyle = cur_cir_color;
                ctx.lineWidth=cur_line_w;
                ctx.arc(cur_cir_r/2, cur_cir_r/2, cur_cir_r/2, 0, Math.PI*(percent/100)*360/180, false);
                ctx.stroke();
            }
        });
    };
})(jQuery);
