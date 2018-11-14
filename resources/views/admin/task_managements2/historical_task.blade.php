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
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">
                   <dl>
                       <dt>年份：</dt>
                       <dd>
                           @foreach($historical_task as $key=>$item)
                            <a href="{{ route('admin.task_managements.historical_task') }}?year={{  $key }}" class="@if($year==$key) active @endif" >{{ $key }}</a>
                           @endforeach
                       </dd>
                        <div class="clear"></div>
                   </dl>
                    <dl>
                        <dt>月份：</dt>
                        <dd>
                                @foreach($historical_task[$year] as $key2=>$item2)
                                <a href="{{ route('admin.task_managements.historical_task') }}?year={{ $year }}&&mouth={{ $key2 }}" class="@if($mouth==$key2) active @endif">{{ $key2 }}</a>
                                @endforeach
                        </dd>
                        <div class="clear"></div>
                    </dl>
                    {!! $DivisionalManagementParamenter->category_tree($divisional_managements,$prefix='',$parent_id,$year,$mouth) !!}
                </div>
                <b class="tips">数据仅供参考，请以财务提供数据为准！(涉及价、税分离，订单返利等)</b>
                @include('admin.task_managements.table.progress')
            </div>
        </div>
    </div>
@endsection