<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>@yield('title','网烁帐号设置')-网烁信息科技有限公司</title>
    <meta name="keywords" content="@yield('keywords','keywords')"/>
    <meta name="description" content="@yield('description','description')"/>
    <link rel="stylesheet" href="{{ asset('styles/iview.css') }}" type="text/css">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="register_body" >
    <div class="wrap" id="app">
        <div class="logo_bg">
            <a class="logo" href="/"><img src="{{ json_decode(getImages(setting('system_logo')),true)[0]['url'] }}"></a>
        </div>
        <h5 class="typeName">设置账号密码</h5>

        <div class="registerInfoBox">
            <div class="method_box tab_box" >
                @php dump(cache()->get('phone_code')) @endphp
                <div class="step4" >
                    <ul name="mobile"  class="tab">
                        <li :class="{ errorBorder: errors.has('phone') }">
                            <label>
                                <input type="text"
                                       v-model="phone"
                                       name="phone"
                                       v-validate="'required|mobile|number_unique'"
                                       data-vv-as="手机号"
                                       placeholder="请输入手机号"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('phone')"><i></i>
                                <p>@{{ errors.first('phone') }}</p></div>
                        </li>
                        <li  :class="{ errorBorder: errors.has('phone_code') }">
                            <label>
                                <input type="text"
                                       v-model="phone_code"
                                       name="phone_code"
                                       v-validate="'required|alpha_num|min:6|max:6|check_code:phone_code'"
                                       data-vv-as="验证码"
                                       placeholder="请输入手机验证码"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('phone_code')"><i></i>
                                <p>@{{ errors.first('phone_code') }}</p></div>
                            <a class="repSend canSend" @click="send('{{ route('binding_authorization.send') }}',phone,'phone')">@{{content}}</a></li>
                        <li :class="{ errorBorder: errors.has('username') }">
                            <label>
                                <input type="text"
                                       v-model="username"
                                       name="username"
                                       v-validate="'required|alpha_num|min:4|max:15|number_unique'"
                                       data-vv-as="用户名"
                                       placeholder="用户名（4-15位英文,数字,下划线）"
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
                                       v-validate="'required|alpha_num|min:6|max:20'"
                                       data-vv-as="密码"
                                       placeholder="密码（6-20位数字、英文）"
                                       ref="password"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('password')"><i></i>
                                <p>@{{ errors.first('password') }}</p></div>
                        </li>
                        <li :class="{ errorBorder: errors.has('password_confirmation ') }">
                            <label>
                                <input type="password"
                                       v-model="password_confirmation "
                                       name="password_confirmation "
                                       v-validate="'required|alpha_num|min:6|max:20|confirmed:password'"
                                       data-vv-as="确认密码"
                                       placeholder="再次输入密码"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('password_confirmation ')"><i></i>
                                <p>@{{ errors.first('password_confirmation ') }}</p></div>
                        </li>
                    </ul>
                    <div class="agrees">
                        <input type="checkbox"
                               class="agree"
                               v-model="checked "
                               name="checked "
                               v-validate="'required'"
                               data-vv-as="服务条例"
                               :checked="checked"
                        >
                        我已经阅读并接受<a href="{:U('/support_40')}" target="_blank">《网烁科技服务条例》</a>
                        <div class="vee_error" v-show="errors.has('checked ')"><i></i>
                            <p>@{{ errors.first('checked ') }}</p></div>
                    </div>
                    <div class="button sub_now"  @click="wechat_save('{{ route('register.wechat_store') }}')"><a>确认提交</a></div>
                </div>
                <!-- 第三步完成  -->
            </div>
        </div>

        <div class="method_box tab_box">
            <div class="loginNow">我有帐户，<a href="{{ route('account.bind') }}">绑定账号</a></div>
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
<script type="text/javascript" src="{{ asset('js/register.js') }}"></script>
<script>
    var url="{{ route('site.login') }}";
    var location_url="{!! url()->previous() !!}";
</script>
</html>
