@extends('admin.layout.default')
@inject('DivisionalManagementParamenter','App\Presenters\DivisionalManagementParamenter')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create divisional_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.task_managements.index') }}?type">任务列表</button>
                @endcan
                @can('delete divisional_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/divisional_managements/destory') }}">删除
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
                <input type="hidden" name="table" value="divisional_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">对象</th>
                    <th class="">模式</th>
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
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
                </tr>
                  @foreach($divisional_managements as $management)
                    @include('admin.divisional_managements.child',['management'=>$management,'level'=>0])
                    @if($management->allChildrens->isNotEmpty())
                        @foreach($management->allChildrens as $department)
                            @include('admin.divisional_managements.child',['management'=>$department,'level'=>1])
                            @if($department->allChildrens->isNotEmpty())
                                @foreach($department->allChildrens as $group)
                                    @include('admin.divisional_managements.child',['management'=>$group,'level'=>2])
                                    @if($group->allChildrens->isNotEmpty())
                                        @foreach($group->allChildrens as $member)
                                            @include('admin.divisional_managements.child',['management'=>$member,'level'=>3])
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                  @endforeach

            </table>
            </form>

        </div>
    </div>

@endsection