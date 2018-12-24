<tr>
    <td class="tableInfoDel">
        @if($level != 0)
        <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $management->id }}">
        @else
         -
        @endif
    </td>
    <td class="tableInfoDel  tablePhoneShow  tableName"
        style='padding-left:{!! $level * 10 !!}px !important'>
        <a class="changeWeb" data_url="{{ route('admin.divisional_managements.edit',$management->id) }}">
           {{ $management->name }}
        </a>
    </td>
    <td class="">{{ $management->task_mode == 'single' ? '单项模式' : '阶梯模式' }}</td>
    <td class="">{{ $management->goal }}</td>
    <td class="">{{ $management->guaranteed_task }}</td>
    <td class="">{{ $management->award_coefficient }}</td>
    <td  class="tableMoreHide">{{ $management->task_mode == 'single' ? 0 : $management->goal_two }}</td>
    <td  class="tableMoreHide">{{ $management->task_mode == 'single' ? 0 : $management->award_coefficient_two }}</td>
    <td  class="tableMoreHide">{{ $management->task_mode == 'single' ? 0 : $management->goal_three }}</td>
    <td  class="tableMoreHide">{{ $management->task_mode == 'single' ? 0 : $management->award_coefficient_three }}</td>
    <td class="">{{ $management->units_index }}</td>
    <td class="">{{ $management->punish_index }}</td>
    <td class="">{{ $management->award_index }}</td>
    <td class="tableMoreHide">{{ $management->created_at->format('Y-m-d') }}</td>
    <td class="">{{ $management->updated_at->format('Y-m-d') }}</td>
    <td class="">
       @if (empty($management->admin_id))
       <a class="alertWeb" data_url="{{ route('admin.divisional_managements.create') }}?parent_id={{ $management->id }}">添加下级</a>
       @else
           ----
        @endif
    </td>



</tr>