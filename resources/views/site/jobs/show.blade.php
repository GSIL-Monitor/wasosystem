@extends('site.layouts.default')
@section('title',$job->field['position'])
@section('css')
    <link rel="stylesheet" href="{{ asset('css/job.css') }}">
@endsection
@section('js')
@endsection
@section('content')
    <div class="body">
        <div id="crumbs"><div class="wrap">当前位置：<a href="{{ route('job.index') }}">网烁招聘</a> >{{ $job->field['position'] }}</div></div>

        <div class="wrap">
            <div class="job_contact">
                <h5 class="jobName">{{ $job->field['position'] }}</h5>

                <ul class="jobType">
                    <li>职位类别：{{ $job->field['position_type'] }}</li>
                    <li>工作地点：{{ $job->field['workplace'] }}</li>
                    <li>招聘人数：{{ $job->field['recruiting_numbers'] }}人</li>
                    <div class="clear"></div>
                </ul>
                <div class="jobCon">{!! $job->field['job_description'] !!} </div>
                <div class="prep"><a href="{{ route('job.index') }}">返回列表</a></div>
            </div>


        </div>
    </div>

@endsection