@inject('DivisionalManagementParamenter','App\Presenters\DivisionalManagementParamenter')
<div id="bing">
    <div class="total">
        <div class="picTotal Add_form">
            <table class="listTable">
                <tr>
                    <th>任务对象</th>
                    <th class="tableInfoDel"><i class="MBI"></i>目标任务<i class="BDI"></i>保底任务<i class="YHI"></i>已回款</th>
                    <th style="text-align: right;">目标任务</th>
                    <th style="text-align: right;">保底任务</th>
                    <th style="text-align: right;">已回款</th>
                    <th style="text-align: right;">当月销售</th>
                    <th style="text-align: right;">发出未结</th>
                    <th style="text-align: right;">奖惩</th>
                </tr>
                @if(Route::is('admin.task_managements.task_progress'))
                {!! $DivisionalManagementParamenter->ProgressOfTheStatistics($divisional_managements,$prefix='',$parent_id) !!}
                @else
                {!! $DivisionalManagementParamenter->historical_task($divisional_managements,$prefix='',$parent_id,$year,$mouth) !!}
                @endif

            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>