@extends('site.layouts.default')
@section('title','服务支持')
@section('css')
    <link href="{{ asset('css/service_support.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script>
        $(".drive_box ul li").eq(1).addClass("midLi");
    </script>
@endsection
@section('content')
     @include('site.service_supports.body')
@endsection