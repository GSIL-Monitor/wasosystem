<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>

</head>
<body>

    <div class="animsition">
        <div style="overflow: hidden;">
            <div id="main" ></div>
            <div id="main2" style="height:250px; width: 280px; float: left;overflow: hidden;"></div>
        </div>
    </div>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="<?php echo e(asset('css/RFM/js/jquery.animsition.min.js')); ?>"></script>
<script src="https://cdn.bootcss.com/echarts/3.5.3/echarts.min.js"></script>
<script src="<?php echo e(asset('css/RFM/js/macarons .js')); ?>"></script>
<script>
    $(document).ready(function() {
        //初始化切换
        $(".animsition").animsition({

            inClass               :   'fade-in-right',
            outClass              :   'fade-out',
            inDuration            :    1500,
            outDuration           :    800,
            linkElement           :   '.animsition-link',
            // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
            loading               :    true,
            loadingParentElement  :   'body', //animsition wrapper element
            loadingClass          :   'animsition-loading',
            unSupportCss          : [ 'animation-duration',
                '-webkit-animation-duration',
                '-o-animation-duration'
            ],
            //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

            overlay               :   false,

            overlayClass          :   'animsition-overlay-slide',
            overlayParentElement  :   'body'
        });

        // 基于准备好的dom，初始化echarts实例
        var myChart2 = echarts.init(document.getElementById('main2'),'macarons');
        // 指定图表的配置项和数据
        var option2 = {
            tooltip: {
                trigger: 'item',
                formatter: function(data){
//                    myChart2.setOption({
//                        title : {
//                            text: '会员数量' + data.value,
//                        }
//                    });
                    return data.name + '</br>' + '人数：' + data.value + '</br>占比：' + data.percent + '%'+'</br>';
                }
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
//                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            legend: {
                orient: 'horizontal', // 'vertical'
                icon:'pie',
//                 orient: 'vertical',
                x: 'right',
                y: 'bottom',
                selectedMode:true,
                data:['意向订单(<?php echo e($intention_to_order); ?>)','下单订货(<?php echo e($placing_orders); ?>)','订单受理(<?php echo e($order_acceptance); ?>)'
                    ,'在途运输(<?php echo e($in_transportation); ?>)','确认到货(<?php echo e($arrival_of_goods); ?>)']
            },
            series: [
                {
                    name:'各级别会员人数',
                    center:['50%','35%'],
                    type:'pie',
                    radius: ['50%', '65%'],
                    avoidLabelOverlap: false,
                    label: {
                        normal: {
                            show: false,
                            position: 'center',
                        },
                        emphasis: {
                            show: true,
                            textStyle: {
                                fontSize: '20',
                                fontWeight: 'bold'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data:[
                        { value:'<?php echo e($intention_to_order); ?>',name:'意向订单(<?php echo e($intention_to_order); ?>)' },
                        { value:'<?php echo e($placing_orders); ?>',name:'下单订货(<?php echo e($placing_orders); ?>)' },
                        { value:'<?php echo e($order_acceptance); ?>',name:'订单受理(<?php echo e($order_acceptance); ?>)' },
                        { value:'<?php echo e($in_transportation); ?>',name:'在途运输(<?php echo e($in_transportation); ?>)' },
                        { value:'<?php echo e($arrival_of_goods); ?>',name:'确认到货(<?php echo e($arrival_of_goods); ?>)' }
                    ]
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart2.setOption(option2);
    });
</script>

</body>
</html>
