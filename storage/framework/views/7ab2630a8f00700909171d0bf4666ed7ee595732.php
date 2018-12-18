
<?php $__env->startSection('js'); ?>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <script src="<?php echo e(asset('css/RFM/js/jquery.animsition.min.js')); ?>"></script>
    <script src="https://cdn.bootcss.com/echarts/3.5.3/echarts.min.js"></script>
    <script src="<?php echo e(asset('css/RFM/js/macarons .js')); ?>"></script>
    <script>
        $(document).ready(function () {
            //初始化切换
            $(".animsition").animsition({

                inClass: 'fade-in-right',
                outClass: 'fade-out',
                inDuration: 1500,
                outDuration: 800,
                linkElement: '.animsition-link',
                // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
                loading: true,
                loadingParentElement: 'body', //animsition wrapper element
                loadingClass: 'animsition-loading',
                unSupportCss: ['animation-duration',
                    '-webkit-animation-duration',
                    '-o-animation-duration'
                ],
                //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
                //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

                overlay: false,

                overlayClass: 'animsition-overlay-slide',
                overlayParentElement: 'body'
            });

            // 基于准备好的dom，初始化echarts实例

            var myChart3 = echarts.init(document.getElementById('main3'), 'macarons');


            function my_data() {
                var data = [];
                for (var i = 0; i < 30; i++) {
                    data.push(Math.round(Math.random() * (500 - 100) + 100));
                }
                ;
                console.log(data);
                return data;
            }

            var option3 = {
                title: {
                    text: '销售情况'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                        type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                legend: {
                    data: <?php echo $topData; ?>

                },
                toolbox: {
                    show: true,
                    feature: {
                        mark: {show: true},
                        dataView: {show: true, readOnly: false},
                        magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                        restore: {show: true},
                        saveAsImage: {show: true}
                    }
                },
                calculable: true,
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: true,
                        data:<?php echo $label; ?>

                    }
                ],
                yAxis: [
                    {
                        type: 'value'
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
                series: <?php echo $data; ?>

            };


            // 使用刚指定的配置项和数据显示图表。

            myChart3.setOption(option3);


        });
        var vm = new Vue({
            el: "#app",
            data: {
                dates:<?php echo json_encode($date); ?>,
                admins:<?php echo json_encode($admins); ?>

            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox" >
        <div class="PageBtn" id="app">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
              <?php echo $__env->make('admin.common._search',[
              'url'=>route('admin.marketing_statistics.index'),
              'status'=>array_except(Request::all(),['type','keyword','_token']),

              'show_input'=>false,
              'select_data'=>['相关整机'=>'所属分类',"class"=>' select2','multiple'],
              'placeholder'=>'请输入工号,多工号 ",隔开" ',
               'select'=>"<date-picker-filtrate :default-date='dates'  ></date-picker-filtrate>",
               'btn'=>'查询'
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="animsition">
                <div style="overflow: hidden;">
                    <div id="main3" style="height:350px; width: 1020px; clear: both;overflow: hidden;"></div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>