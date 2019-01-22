<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>

</head>
<body>

    <div class="animsition">
    <div style="overflow: hidden;">
        <div id="main3" style="height:350px; width: 1020px; clear: both;overflow: hidden;" ></div>
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

            var myChart3 = echarts.init(document.getElementById('main3'),'macarons');




            function my_data(){
                var data = [];
                for( var i =0; i<30; i++){
                    data.push(Math.round(Math.random() * (500 - 100) + 100));
                };
                console.log(data);
                return data;
            }

            var option3 = {
                title : {
                    text: '产品库存情况'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                legend: {
                    data:['新品','良品','坏货','返厂在途','代管','测试品']
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : true,
                        data :<?php echo $label; ?>

                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                grid: {
                    left: '3%',
                    right: '4%',
                    containLabel: true
                },
                dataZoom: [{
                    type: 'inside',
                    start: 1,
                    end: 100,
                }, {
                    start: 1,
                    end: 100,
                    handleSize: '80%',
                    handleStyle: {
                        color: '#fff',
                        shadowBlur: 3,
                        shadowColor: 'rgba(0, 0, 0, 0.6)',
                        shadowOffsetX: 2,
                        shadowOffsetY: 2
                    }
                }],
                series : <?php echo $data; ?>

            };



            // 使用刚指定的配置项和数据显示图表。

            myChart3.setOption(option3);



        });
    </script>

</body>
</html>
