@extends('admin.layout.default')
@inject('DivisionalManagementParamenter','App\Presenters\DivisionalManagementParamenter')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/progress.css') }}">

@endsection
@section('js')
     <script src="{{ asset('admin/js/jq.canvaspercent.js') }}"></script>

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
                    {!! $DivisionalManagementParamenter->chart_tree($divisional_management,$parent_id,$year,$mouth) !!}
                    <dl>
                        <dt>年统计：</dt>
                        <dd>
                            @foreach($years as $item)
                                <a href="{{ route('admin.task_managements.marketing_statistics') }}?year={{  $item.array_to_url(\request()->only(['parent_id','mouth'])) }}"
                                   class="@if($year==$item) active @endif">{{ $item }}</a>
                            @endforeach
                        </dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>月统计：</dt>
                        <dd>
                            @foreach($mouths as $item)
                                <a href="{{ route('admin.task_managements.marketing_statistics') }}?year={{ $year }}&mouth={{ $item.array_to_url(\request()->only(['parent_id'])) }}" class="@if($mouth==$item) active @endif">{{ $item }}</a>
                            @endforeach
                        </dd>
                        <div class="clear"></div>
                    </dl>
                </div>
                @include('admin.task_managements.table.chart')
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection