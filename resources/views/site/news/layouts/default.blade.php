<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <meta HTTP-EQUIV="expires" CONTENT="0">
    <title>@yield('title','网烁动态')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords','keywords')"/>
    <meta name="description" content="@yield('description','description')"/>

    @yield('meta')
    {{-- 公用css --}}
    @include('site.layouts.css')
    {{-- 公用js --}}
    @include('site.layouts.js')
    {{-- 专有css --}}
    @yield('css')
</head>
<body @guest('user')onselectstart="return false" CloseOpen  @endguest>
{{-- 动态内容 --}}
@include('site.news.layouts.head')
@yield('content')
@include('site.news.layouts.foot')
{{-- 专有js --}}
@yield('js')
<script>
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
        /*  登录显示*/
        $('#news_header .user').mouseenter(function(){
            $('.user_box').slideDown(200);
        });
        $('#news_header .user').mouseleave(function(){
            $('.user_box').stop().slideUp(200);
        });

        /*    搜索框变化  */
        $(document).on("focus","#news_header .search_box .searchBorder input",function(){
            $(this).siblings("i").hide();
        });

        $(document).on("blur","#news_header .search_box .searchBorder input",function(){
            var val = $(this).val();
            if(val==""||val==" "){
                $(this).siblings("i").show();
            }
        });

        $(document).on("click","#news_header .search_box .searchBorder span",function(){
            var val = $(this).siblings("input").val();
            var reval = $(this).siblings("i").text();
            if(val==""||val==" "){
                val = reval;
            }
            location.href="/Search.html?key="+val;
        });
    });
</script>
</body>
</html>
