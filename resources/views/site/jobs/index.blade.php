@extends('site.layouts.default')
@section('title','加入我们')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/job.css') }}">
    <style>
        .body .jobs .del_through span{
            color:#cccccc;
        }
    </style>
@endsection
@section('js')
    <script>
        $(function(){
            $(".job_type li:nth-child(3n)").addClass("lastLi");
            $('.job_type li').on("click",function(){
                $(this).addClass("li2").siblings("li").removeClass("li2");
            });

        });
    </script>
@endsection
@section('content')
     @include('site.jobs.body')
@endsection