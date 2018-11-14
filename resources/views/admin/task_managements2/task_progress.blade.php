@extends('admin.layout.default')
@inject('DivisionalManagementParamenter','App\Presenters\DivisionalManagementParamenter')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/progress.css') }}">
@endsection
@section('js')
    <script src="{{ asset('admin/js/progress.js') }}"></script>

@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('show historical_task_managements')
                <button class="Btn changeWeb" data_url="{{ route('admin.task_managements.historical_task') }}">历史任务</button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">
                    {!! $DivisionalManagementParamenter->category_tree($divisional_managements,$prefix='',$parent_id,'','') !!}
                </div>
                <b class="tips">数据仅供参考，请以财务提供数据为准！(涉及价、税分离，订单返利等)</b>
                @include('admin.task_managements.table.progress')
            </div>
        </div>
    </div>
@endsection