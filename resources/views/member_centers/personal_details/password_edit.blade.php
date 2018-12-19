@extends('member_centers.default')
@section('title','密码修改')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/binding_authorizations.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/edit_password.js')}}"></script>

@endsection
@section('content')
    <div class="right">
        <div class="info">
            <div class="tit bigTit">
                <h5>修改密码</h5>
                <p>定期修改密码可以有效的防止陌生人盗取您的帐号，保证您的账户安全。</p>
            </div>
            <div class="editNum emailBox" >
                <div  >
                    <div class="editBox">
                        <ul class="safeUl">
                            <li :class="{ errorBorder: errors.has('old_password') }">
                                <label>旧密码</label>
                                <input type="password"
                                       v-model="old_password"
                                       name="old_password"
                                       v-validate="'required|user_password'"
                                       data-vv-as="旧密码"
                                       placeholder="请输入旧密码"

                                >

                                <div class="vee_error" v-show="errors.has('old_password')"><i></i>
                                    <p>@{{ errors.first('old_password') }}</p></div>
                            </li>
                            <li :class="{ errorBorder: errors.has('password') }">
                                <label>新密码</label>
                                <input type="password"
                                       v-model="password"
                                       name="password"
                                       v-validate="'required|alpha_num|min:6|max:20'"
                                       data-vv-as="密码"
                                       placeholder="密码（6-20位数字、英文）"
                                       ref="password"
                                >

                                <div class="vee_error" v-show="errors.has('password')"><i></i>
                                    <p>@{{ errors.first('password') }}</p></div>
                            </li>
                            <li :class="{ errorBorder: errors.has('password_confirmation') }">
                                <label>确认密码</label>
                                <input type="password"
                                       v-model="password_confirmation"
                                       name="password_confirmation"
                                       v-validate="'required|alpha_num|min:6|max:20|confirmed:password'"
                                       data-vv-as="确认密码"
                                       placeholder="再次输入密码"
                                >

                                <div class="vee_error" v-show="errors.has('password_confirmation')"><i></i>
                                    <p>@{{ errors.first('password_confirmation') }}</p></div>
                            </li>

                        </ul>
                        <div class="button" @click="save('{{ url('/personal_details/'.$user->id) }}')">修改密码</div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!--   解绑 -->
             </div>
                <!--   接收验证码 -->
            </div>

        </div>
    </div>
@endsection