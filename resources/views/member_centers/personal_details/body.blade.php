<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>个人信息</h5>
                        <p>完善个人资料，以便我们及时与您取得联系</p>
                    </div>


                    <div class="detail_info">
                        <div class="person_info">
                            <ul class="tab">
                                {!! Form::model($user,['route'=>['personal_details.update',$user->id],'id'=>'personal_details','method'=>'put','onsubmit'=>'return false']) !!}
                                <li>
                                        <span class="liTit">用户名：</span>
                                        <span>
                                            {!! Form::text('username',old('username'),['disabled']) !!}
                                        </span>
                                        <div class="clear"></div>
                                    </li>

                                    <li>
                                        <span class="liTit">真实姓名：</span>
                                        <span>
                                             {!! Form::text('nickname',old('nickname'),['disabled']) !!}
                                        </span>
                                        <div class="clear"></div>
                                    </li>

                                    <li>
                                        <span class="liTit">联系方式：</span>
                                        <span>
                                            {!! Form::text('phone',old('phone'),['disabled']) !!}
                                            <a href="{{ route('binding_authorization.index') }}">[修改]</a></span>
                                        <div class="clear"></div>
                                    </li>

                                    <li>
                                        <span class="liTit">邮箱地址：</span>
                                        <span>
                                               {!! Form::text('email',old('email'),['disabled']) !!}
                                            <a href="{{ route('binding_authorization.index') }}">[修改]</a></span>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="MustW canChange">
                                        <span class="liTit">Q&nbspQ号码：</span>
                                        <span>
                                        {!! Form::text('qq',old('qq'),['placeholder'=>'请填写QQ号码']) !!}
                                      </span>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="canChange">
                                        <span class="liTit">生日：</span>
                                        <span> {!! Form::text('birthday',old('birthday'),['placeholder'=>'请填写您的生日(例：6-1)']) !!}</span>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="canChange">
                                        <span class="liTit">微信号：</span>
                                        <span>
                                            {!! Form::text('wechat',old('wechat'),['placeholder'=>'请填写微信名称']) !!}
                                      </span>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="canChange noBorder">
                                        <span class="liTit">性别：</span>
                                        <span>
                                        <div class="sex_choose">
                                            @foreach(config('site.member_center_personal_details') as $key=>$item)
                                                <label for="{{ $key }}">
                                                {!! Form::radio('sex',$key,old('sex',true),['id'=>$key]) !!} {{ $item }}
                                               </label>
                                            @endforeach
                                        </div>
                                      </span>
                                        <div class="clear"></div>
                                    </li>
                                    <li class="canChange noBorder">
                                        <span class="liTit">信息接收：</span>
                                        <span>
                                        <div class="sex_choose">
                                          @foreach(config('status.userInfo') as $key=>$item)
                                                <label for="{{ $key }}">
                                                {!! Form::radio('message_type',$key,old('message_type',true),['id'=>$key]) !!} {{ $item }}
                                               </label>
                                            @endforeach
                                        </div>
                                      </span>
                                        <div class="clear"></div>
                                    </li>
                                    <li class="check_info_box">
                                        <span class="liTit">&nbsp;</span>
                                        <span><p></p></span>
                                        <div class="clear"></div>
                                    </li>
                                {!! Form::close() !!}
                            </ul>

                            <div class="button common_add" form_id="personal_details"><a>保存</a></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
            </div>
