@inject('Divisional1ManagementParamenter','App\Presenters\DivisionalManagementParamenter')
{{--<div class="container">--}}
    {{--<canvas id="chart" width="550" height="500"></canvas>--}}
    {{--<div class="chartData">--}}
        {{--<table id="chartData">--}}
            {{--<tr>--}}
                {{--<th>来源比例</th>--}}
                {{--<th>数量</th>--}}
            {{--</tr>--}}
            {{--{!! $DivisionalManagementParamenter->chart($divisional_managements,$parent_id,$year,$mouth) !!}--}}
        {{--</table>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<section class="container">--}}
    {{--{!! $DivisionalManagementParamenter->PieBox($divisional_managements,$parent_id,$year,$mouth) !!}--}}
{{--</section>--}}
<div class="bingBox">

    <div class="pieBigMode">
            {!! $DivisionalManagementParamenter->chart($divisional_managements,$parent_id,$year,$mouth) !!}
    </div>


    <ul class="pies">
        {!! $DivisionalManagementParamenter->PieBox($divisional_managements,$parent_id,$year,$mouth) !!}
    </ul>
</div>
<script>
    $(function () {
        /* 营销统计 li宽高  */
        function bindZhi(){
            var totalWidth = $(".bindLine").width();
            $('.bindBox li').each(function () {
                var num =parseInt($(this).find('.bindZhi').attr('data_num'));
                var liWidth = Math.floor(num / 100 * totalWidth) + "px";
                $(this).find(".zhi").text(num + "%");
                $(this).find(".lines").css("width",liWidth);
            });
        }
        bindZhi();
        $('.perCanvas').drawCanvasPercent();
    });
</script>
