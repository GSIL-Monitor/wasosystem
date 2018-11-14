<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','登陆')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords','keywords')"/>
    <meta name="description" content="@yield('description','description')"/>
    <link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="login_logo">
    <div class="wrap">
        <div class="logoBox"><a href="/"><img src="{{ asset('pic/loginLogo.jpg') }}"></a></div>
    </div>
</div>
<div id="login_body">
    <div class="wrap">
        <a href="/" class="adLinks"></a>
        <div class="loginBox">
            <h5 class="title">用户登录</h5>
            {{ Form::open(['route'=>'site.login','method'=>'post','id'=>'login']) }}

            <ul class="login_box tab_box">
                <li><label><input placeholder="用户名/手机号/邮箱地址" type="text"  class="name" name="username" autocomplete="off" ></label></li>
                <li><label><input placeholder="请输入密码" type="password" class="pwd" name="password" autocomplete="off"></label></li>
                <li class="checkcode"><label><input placeholder="输入验证码" type="text" name="captcha"  class="code" autocomplete="off"></label><div class="code_pic"><img title="点击刷新" id="che_pic" src="{!! captcha_src('waso') !!}" align="absbottom" onClick="this.src=this.src+'?'+Math.random()" style="cursor: pointer"></div><div class="suc_msg"></div><div class="clear"></div></li>
                <li class="check_info_box"><div class="error_msg"><i></i><p></p></div></li>
            </ul>
            {{--{{ Form::submit('登陆') }}--}}
            {{ Form::close() }}
            <div class="submit">
                <i class="wait"><img src="{{ asset('pic/wait.gif') }}"></i>
                <a id="sub" >立即登录</a>
            </div>
            <div class="other">
                <a href="{{ route('register') }}">注册新用户</a>
                <span>|</span>
                <a href="">忘记密码？</a>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="login_foot">
    <div class="wrap">
        <h5>Copyright © <span class="year"></span> 成都网烁信息科技有限公司 版权所有<br> ICP备案编号：蜀 ICP(备)10025767号</h5>
    </div>
</div>

</body>
<script type="text/javascript" src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/placehold.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/public.js') }}"></script>
<script src="{{ asset('admin/js/xuliehua.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('js/jquery.qrcode.min.js') }}"></script>
<script src="{{ asset('admin/js/axios.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

<script>
        var url="{{ route('site.login') }}";
        var location_url="{!! url()->previous() !!}";
</script>
</html>
