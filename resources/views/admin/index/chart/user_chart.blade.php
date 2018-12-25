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
            <div id="main2" style="height:290px; width: 220px; float: left;overflow: hidden;"></div>
        </div>
    </div>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="{{ asset('css/RFM/js/jquery.animsition.min.js') }}"></script>
<script src="https://cdn.bootcss.com/echarts/3.5.3/echarts.min.js"></script>
<script src="{{ asset('css/RFM/js/macarons .js') }}"></script>
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
                    return data.name + '</br>' + '数量：' + data.value + '</br>占比：' + data.percent + '%'+'</br>';
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
                data:['未认证({{ $unverified }})','冻结账户({{ $blocked_account }})','零售价格({{ $retail_price }})'
                    ,'淘宝价({{ $taobao_price }})','会员价({{ $member_price }})','合作价({{ $cooperation_price }})','核心价({{ $core_price }})',
                    '成本价({{ $cost_price }})']
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
                        {value: "{{ $unverified }}", name: '未认证({{ $unverified }})'},
                        {value: "{{ $blocked_account }}", name: '冻结账户({{ $blocked_account }})'},
                        {value: "{{ $retail_price }}", name:'零售价格({{ $retail_price }})'},
                        {value: "{{ $taobao_price }}", name:'淘宝价({{ $taobao_price }})'},
                        {value: "{{ $member_price }}", name: '会员价({{ $member_price }})'},
                        {value: "{{ $cooperation_price }}", name: '合作价({{ $cooperation_price }})'},
                        {value: "{{ $core_price }}", name: '核心价({{ $core_price }})'},
                        {value: "{{ $cost_price }}", name: '成本价({{ $cost_price }})'}
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
