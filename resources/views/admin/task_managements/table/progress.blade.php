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
                    {{--<th style="text-align: right;">已回款</th>--}}
                    <th style="text-align: right;">当月销售</th>
                    <th style="text-align: right;">发出未结</th>
                    <th style="text-align: right;">奖惩</th>
                </tr>

                @foreach($divisional_management_lists as $divisional_management_list)
               <tr class="{{ $divisional_management_list->identifying }}  parent_{{ $divisional_management_list->id  }}" data-pid="{{ $divisional_management_list->parent_id }}" data-id="{{ $divisional_management_list->id }}">
                   <td class="tableInfoDel tablePhoneShow tableName" >{{ $divisional_management_list->name }}</td>
                   <td class="tableInfoDel" >
                        <div class="JDBox">
                            <span class="goal"><i>{{ $DivisionalManagementParamenter->calculation($divisional_management_list->task->goal ?? 0) }} </i></span><span class="guaranteed_task"><i>{{ $DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0) }} </i></span><span class="returned_money"><i>{{ $DivisionalManagementParamenter->returned_money($divisional_management_list->admins) }}</i></span>
                        </div>
                    </td>
                   <td class=""><span class="MBIWords">{{ $DivisionalManagementParamenter->calculation($divisional_management_list->task->goal ?? 0) }}</span></td>
                   <td class=""><span class="BDIWords">{{ $DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0) }}</span></td>
                   {{--<td class=""><span class="YHIWords">{{ $DivisionalManagementParamenter->returned_money($divisional_management_list->admins) }}</span></td>--}}
                   {{--<td class=""><span class="monthly_sales">{{ $DivisionalManagementParamenter->monthly_sales($divisional_management_list->admins,$year,$mouth) }}</span></td>--}}
{{--                   <td class=""><span class="outstanding">{{ $DivisionalManagementParamenter->outstanding($divisional_management_list->admins,$year,$mouth) }}</span></td>--}}

                   <td class=""><span class="">{{ $DivisionalManagementParamenter->RewardsAndPunishment(
                   $divisional_management_list,
                   $DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0),
                   $DivisionalManagementParamenter->returned_money($divisional_management_list->admins)
                   ) }}</span></td>
                   </tr>
                    @endforeach
            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>