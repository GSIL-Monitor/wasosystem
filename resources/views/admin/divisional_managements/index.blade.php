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
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>

                </tr>

                {!! $DivisionalManagementParamenter->tree($divisional_managements,$prefix='',88) !!}
            </table>
            </form>

        </div>
    </div>

@endsection