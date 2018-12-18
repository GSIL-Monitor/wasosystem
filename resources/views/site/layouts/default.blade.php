<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','首页')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords',setting('system_keyWord'))"/>
    <meta name="description" content="@yield('description', setting('system_description'))"/>
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
@include('site.layouts.head',['common_complete_machines'=>$common_complete_machines])
@yield('content')
@include('site.layouts.foot',['common_solutions'=>$common_solutions])
{{-- 专有js --}}
@yield('js')
<script>
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
{!! setting('system_baidu_statistics') !!}
</body>
</html>
