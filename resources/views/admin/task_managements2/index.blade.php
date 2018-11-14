@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create task_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.divisional_managements.index') }}?type">添加任务</button>
                @endcan
                @can('delete task_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/task_managements/destory') }}">删除
                    </button>
                @endcan
                @if(request()->has('type'))
                <button class="changeWebClose Btn">返回</button>
                @endif
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="task_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">模式</th>
                    <th class="tableInfoDel">对象</th>
                    <th class="">目标任务(万)</th>
                    <th class="">保底任务(万)</th>
                    <th class="">奖励系数(%)</th>
                    <th  class="tableMoreHide">目标阶段二(万)</th>
                    <th  class="tableMoreHide">奖励系数二(%)</th>
                    <th  class="tableMoreHide">目标阶段三(万)</th>
                    <th  class="tableMoreHide">奖励系数三(%)</th>
                    <th class="">单位指标(万)</th>
                    <th class="">处罚指标(元)</th>
                    <th class="">奖励标准(元)</th>
                </tr>

                @forelse($task_managements as $task_management)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $task_management->id }}">
                        </td>
                        <td class="">{{ $task_management->task_mode == 'single' ? '单项模式' : '阶梯模式' }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.task_managements.edit',$task_management->id) }}">{{ $task_management->divisional->name }}</a>
                        </td>
                        <td class="">{{ $task_management->goal }}</td>
                        <td class="">{{ $task_management->guaranteed_task }}</td>
                        <td class="">{{ $task_management->award_coefficient }}</td>
                        <td  class="tableMoreHide">{{ $task_management->task_mode == 'single' ? 0 : $task_management->goal_two }}</td>
                        <td  class="tableMoreHide">{{ $task_management->task_mode == 'single' ? 0 : $task_management->award_coefficient_two }}</td>
                        <td  class="tableMoreHide">{{ $task_management->task_mode == 'single' ? 0 : $task_management->goal_three }}</td>
                        <td  class="tableMoreHide">{{ $task_management->task_mode == 'single' ? 0 : $task_management->award_coefficient_three }}</td>
                        <td class="">{{ $task_management->units_index }}</td>
                        <td class="">{{ $task_management->punish_index }}</td>
                        <td class="">{{ $task_management->award_index }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $task_managements->links() }}
        </div>
    </div>

@endsection