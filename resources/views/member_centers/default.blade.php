<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','首页')-网烁信息科技有限公司</title>
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
<body @guest('user')onselectstart="return false" CloseOpen onbeforeunload="shijian()" @endguest>
{{-- 动态内容 --}}
@include('site.layouts.head',['common_complete_machines'=>$common_complete_machines])
    <div class="body" id="app" >
        <div class="wrap">
            <i class="PhoneSearch"></i>
        </div>

        <div id="crumbs">
            <div class="wrap"><a href="/">首页</a> > <a href="{{ route('member_center') }}">个人中心</a> > @yield('title','')</div>
        </div>

        <div class="wrap">
            <div class="info_box">
                <div class="left">
                    @include('member_centers.person_links')
                </div>

                @yield('content')
                <div class="clear"></div>
            </div>
        </div>
    </div>
@include('site.layouts.foot',['common_solutions'=>$common_solutions])
{{-- 专有js --}}
@yield('js')
</body>
</html>
