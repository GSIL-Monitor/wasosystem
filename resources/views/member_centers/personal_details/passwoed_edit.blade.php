@extends('member_centers.default')
@section('title','密码修改')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/pwd.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script></script>
@endsection
@section('content')
    <div class="right">
        <div class="info">
            <div class="tit bigTit">
                <h5>修改密码</h5>
                <p>定期修改密码可以有效的防止陌生人盗取您的帐号，保证您的账户安全。</p>
            </div>
            <div class="safe">
                {!! Form::model($user,['route'=>['personal_details.update',$user->id],'id'=>'personal_details','method'=>'put','onsubmit'=>'return false']) !!}

                <ul>
                    <li>
                        <span class="tit">原密码：</span>
                        <span class="con">
                                          <div class="liRight">
                                                   {!! Form::text('old_password',old('old_password'),['placeholder'=>'请输入旧密码','class'=>'checkNull']) !!}
                                         </div>
                                    </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="tit">新密码：</span>
                        <span class="con">
                                        <div class="liRight">
                                            <input type="text" name="password" value="{{ old('password') }}"
                                                   placeholder="6-20位数字、英文" class="checkNull">
                                            </div>

                                </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="tit">再次确认：</span>
                        <span class="con">
                                                <div class="liRight">
                                        {!! Form::text('password_confirmation',old('password_confirmation'),['placeholder'=>'6-20位数字、英文','class'=>'checkNull']) !!}
                                                </div>

                                </span>
                        <div class="clear"></div>
                    </li>
                    <li class="check_info_box"><p></p></li>
                </ul>
                {!! Form::close() !!}
                <button class=" common_add" form_id="personal_details">修改</button>
            </div>

        </div>
    </div>
@endsection