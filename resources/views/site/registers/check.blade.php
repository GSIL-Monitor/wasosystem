<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','账号审核中')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords','keywords')"/>
    <meta name="description" content="@yield('description','description')"/>
    <link rel="stylesheet" href="{{ asset('styles/iview.css') }}" type="text/css">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<div id="login_wait">
    <div class="wrap">
        <div class="logo_bg">
            <a class="logo" href="/"><img src="{{ asset('pic/logo.png') }}"></a>
        </div>

        <div class="title"><h5>{{ $user }}<br/>账号审核中</h5></div>

        <div class="thanks">
            <h6>请尽快联系<a name="F_news" class="talkBtn" data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&amp;userId=2178125">在线客服</a>，加快账户认证。再次感谢您对网烁的支持与厚爱，客服热线：400-028-1968</h6>
            <a class="goBackIndex" href="/">返回首页</a>
        </div>

    </div>
</div>

<div id="register_foot">
    <div class="wrap">
        <h5>
            <a href="http://www.miitbeian.gov.cn">{{ setting('system_website_records') }}</a><br/>
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none">
                <img src="{{ asset('pic/beian.png') }}" style="margin-right:3px; vertical-align:middle;"/>{{ setting('system_ministry_public_security_records') }}</a><br>
            Copyright © <span class="year">{{ today()->format('Y') }}</span> {{  setting('system_title') }} 版权所有
        </h5>
    </div>
</div>
</body>
@include('site.layouts.js')
</html>
