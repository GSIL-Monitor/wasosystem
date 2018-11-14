@extends('admin.layout.default')
@section('content')
@inject('CompleteMachineFrameworksParamenter','App\Presenters\CompleteMachineFrameworksParamenter')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create complete_machine_frameworks')
                    <button class="OneAdd Btn" data_title="父级" data_parent_id="0"
                             data_url="{{ route('admin.complete_machine_frameworks.store') }}">添加父级</button>
                    <button class="alertWeb Btn"
                             data_url="{{ route('admin.complete_machine_frameworks.create') }}?parent_id={{ $parent_id }}&category={{ $category }}">添加{{ $parent_parameters[$parent_id] }}{{ config('status.complete_machine_framework')[$category] }}</button>
                @endcan
                @can('edit complete_machine_frameworks')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete complete_machine_frameworks')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/complete_machine_frameworks/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$parent_parameters,'duiBiCanShu'=>$parent_id,'url'=>route('admin.complete_machine_frameworks.index'),'canshu'=>'parent_id'])
            @include('admin.common._lookType',['datas'=>config('status.complete_machine_framework'),'duiBiCanShu'=>$category,'url'=>route('admin.complete_machine_frameworks.index'),'canshu'=>'category','link'=>'&parent_id='.$parent_id])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="complete_machine_frameworks">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    @if($category!='filtrate')
                    <th class="tableInfoDel">排序</th>
                    @endif
                    <th class="tableInfoDel">参数名</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    @if($category=='filtrate')
                    <th >操作</th>
                        @endif
                </tr>
                @if($category !='filtrate')
                @forelse($complete_machine_frameworks as $complete_machine_framework)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $complete_machine_framework->id }}">
                        </td>
                        <td class="tableInfoDel"><input type="text" name="edit[{{ $complete_machine_framework->id }}][order]"
                                    value="{{ $complete_machine_framework->order }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text"  name="edit[{{ $complete_machine_framework->id }}][name]" value="{{ $complete_machine_framework->name }}">
                            <a class="alertWeb" data_url="{{ route('admin.complete_machine_frameworks.edit',$complete_machine_framework->id) }}">{{ $complete_machine_framework->name }}</a>
                        </td>
                        <td class="tableMoreHide">{{ $complete_machine_framework->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $complete_machine_framework->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4"><div class="empty">没有数据</div></td></tr>
                @endforelse
                    @else
                    {!! $CompleteMachineFrameworksParamenter->tree($complete_machine_frameworks,$prefix='',$parent_id) !!}
                @endif
            </table>
            </form>
        </div>
    </div>

@endsection