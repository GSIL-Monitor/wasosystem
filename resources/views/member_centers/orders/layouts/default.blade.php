<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','个人中心')-网烁信息科技有限公司</title>
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
<body>
{{-- 动态内容 --}}
@include('member_centers.orders.layouts.head')
@yield('content')
@include('member_centers.orders.layouts.foot')
{{-- 专有js --}}
@yield('js')
</body>
</html>
