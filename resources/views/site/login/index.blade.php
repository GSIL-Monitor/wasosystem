<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','登录')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords','keywords')"/>
    <meta name="description" content="@yield('description','description')"/>
    {{--<link rel="stylesheet" href="{{ asset('styles/iview.css') }}" type="text/css">--}}
    {{--<link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">--}}
    @include('site.layouts.css')
    <script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
</head>
<body>
<div id="login_logo">
    <div class="wrap">
        <div class="logoBox"><a href="/"><img src="{{ asset('pic/loginLogo.jpg') }}"></a></div>
    </div>
</div>
<div id="login_body">

    <script>
        window.onload=function(){
            var obj = new WxLogin({
                id: "qrCode",
                appid: "{{ setting('wechat_open_appid') }}",
                scope: "snsapi_login",
                redirect_uri: "{{ setting('wechat_open_redirect_uri') }}",
                href: "https://www.waso.com.cn/Public/css/qrCode.css",
                state: "<?php echo time(); ?>",

            });
        }
            </script>
    {{--<div id="qrCode">--}}

    {{--</div>--}}

    <div class="wrap">
        <a href="/" class="adLinks"></a>
        <div class="loginBox" id="app">
           <div class="loginWrap">
               <div class="goToBtn goToWei">
                 <div class="btnTips">点击这里微信登录<i></i></div>
               </div>


               <div class="weiLogin">
                  <h5 class="title">微信登陆 | 便捷安全</h5>

                  <div class="code">
                     <div class="codeBox" id="qrCode">
                       {{--<img src="{{ asset('pic/weixin_hover.jpg') }}">--}}
                     </div>
                  </div>

                  <div class="tips" >
                     <img src="{{ asset('pic/login/login_icon.png') }}">

                      <h5>打开微信扫一扫登录</h5>
                  </div>
               </div>


               <div class="pwdLogin">
                <h5 class="title">用户登录</h5>
    
                {{ Form::open(['route'=>'site.login','method'=>'post','id'=>'login']) }}

                <ul class="login_box tab_box">
                    <li :class="{ errorBorder: errors.has('username') }">
                        <label>
                            <input type="text"
                                v-model="username"
                                name="username"
                                v-validate="'required'"
                                data-vv-as="用户名/手机号/邮箱地址"
                                placeholder="用户名/手机号/邮箱地址"
                            >
                        </label>
                        <div class="vee_error" v-show="errors.has('username')"><i></i>
                            <p>@{{ errors.first('username') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('password') }">
                        <label>
                            <input type="password"
                                v-model="password"
                                name="password"
                                v-validate="'required'"
                                data-vv-as="密码"
                                placeholder="登陆密码"
                            >
                        </label>
                        <div class="vee_error" v-show="errors.has('password')"><i></i>
                            <p>@{{ errors.first('password') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('captcha'),checkcode:true }">
                        <label>
                            <input type="text"
                                v-model="captcha"
                                name="captcha"
                                v-validate="'required|min:3|max:3'"
                                data-vv-as="验证码"
                                placeholder="输入验证码"
                            >
                        </label>
                        <div class="code_pic"><img title="点击刷新" id="che_pic" src="{!! captcha_src('waso') !!}" align="absbottom" onClick="this.src=this.src+'?'+Math.random()" style="cursor: pointer"></div>
                        <div class="vee_error" v-show="errors.has('captcha')"><i></i>
                            <p>@{{ errors.first('captcha') }}</p></div>
                    </li>
                    <li class="check_info_box"></li>
                </ul>
                <label class="remember" ><input type="checkbox" {{ old('remember') ? 'checked' : '' }}>记住我</label>
                <div class="clear"></div>
                {{ Form::close() }}
                <div class="submit">
                    <i class="wait"><img src="{{ asset('pic/wait.gif') }}"></i>
                    <a @click="login"  >立即登录</a>
                </div>
            </div>
           </div>

        
            <div class="other">
                <a href="{{ route('register') }}">注册新用户</a>
                <span>|</span>
                <a href="{{ route('reset_password.index') }}">忘记密码？</a>
                </ul>
            </div>

            <div class="phoneLoginMethod">
              <h5>快速登录</h5>
              <ul>
                <li><a href=""><img src="{{ asset('pic/login/wechat.png') }}"></div></li>
              </ul>
            </div>
        </div>
    </div>
</div>

<div id="login_foot">
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
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/placehold.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/public.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/xuliehua.js') }}" type="text/javascript"></script>--}}

{{--<script type="text/javascript" src="{{ asset('js/jquery.qrcode.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/axios.min.js') }}" type="text/javascript"></script>--}}

{{--<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>--}}


<script>
        var location_url="{!! url()->previous() !!}";
</script>
</html>
