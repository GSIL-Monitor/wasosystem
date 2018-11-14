@extends('site.layouts.default')
@section('title','首页')
@section('css')
    <style>
        .share_div{width:0px;height:0px;overflow:hidden;}
    </style>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/index.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.main_point li').eq(0).addClass("active");
            $('.pic_news li').eq(1).addClass("mid");
            /*  顶部产品  */

            var bodyW = $(window).width();
            if(bodyW>900){
                $(window).scroll(function(){
                    if($(this).scrollTop()>200){
                        $(".indexTopPro").addClass("indexTopProOpen");
                    }
                    else{
                        $(".indexTopPro").removeClass("indexTopProOpen");
                    }
                });
            }
        });

    </script>
@endsection
@section('content')
     @include('site.index.components.indexTopPro')
     @include('site.index.body')
@endsection