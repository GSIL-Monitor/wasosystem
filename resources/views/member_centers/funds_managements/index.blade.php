@extends('member_centers.default')
@section('title','常用配置')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/money.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.9.2.custom.js')}}"></script>
    <script src="{{asset('js/common_equipments.js')}}"></script>
    <script>
        $(function () {


            $(document).ready(function(){
                $("#{{ Request::get('p') ?? 'log' }}").hide().siblings(".PageBox").show();
                $(document).on("click",".PageSelect li",function(){
                    var index = $(this).index();
                    $(this).addClass("active").siblings("li").removeClass("active");
                    $(".MoneyBox .PageBox").eq(index).show().siblings(".PageBox").hide();
                });
            });
            $("#p_header h5").text("资金管理");

        });
    </script>
@endsection
@section('content')
    @include('member_centers.funds_managements.body')
@endsection