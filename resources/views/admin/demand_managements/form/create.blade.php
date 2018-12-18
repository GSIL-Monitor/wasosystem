<div class="JJList zyw">
    <div class="zyw_left" id="app" >
        <ul class="zywUl">
            <Tabs>
                <tab-pane label="客户客情信息" icon="android-contact">
                    <li>
                        <div class="liLeft">需求号：</div>
                        <div class="liRight">
                            {!!  Form::text('demand_number',old('demand_number','SN'.date('YmdHis'),time()),['placeholder'=>'需求号',"class"=>'','readonly']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">访问时间：</div>
                        <div class="liRight">
                            {!!  Form::text('created_at',old('created_at',date('Y-m-d H:i:s'),time()),['placeholder'=>'访问时间',"class"=>'','readonly']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">账号：</div>
                        <div class="liRight">
                            @if(isset($user))
                                {!!  Form::hidden('user_id',old('user_id',$user->id ?? null),['placeholder'=>'账号',"class"=>'checkNull']) !!}
                                @if($user->visitor_details)
                                    {!!  Form::hidden('visitor_details_id',old('visitor_details_id',$user->visitor_details->id ?? null),['placeholder'=>'账号',"class"=>'checkNull']) !!}
                                @endif
                            @endif
                            {!!  Form::text('username',old('username',$visitor_details->user->username ?? $user->username ?? null),['placeholder'=>'账号',"class"=>'checkNull',":disabled"=>'user_disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">客户名称：</div>
                        <div class="liRight">
                            {!!  Form::text('nickname',old('nickname',$visitor_details->user->nickname ?? $user->nickname ?? null),['placeholder'=>'客户名称',"class"=>'checkNull',":disabled"=>'user_disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">客户来源：</div>
                        <div class="liRight">
                            {!!  Form::select('source',$parameters['source'],old('source',$visitor_details->source ?? $user->visitor_details->source ?? null),['placeholder'=>'客户来源',"class"=>'checkNull select2',":disabled"=>'visitor_details_disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">认证级别：</div>
                        <div class="liRight">
                            {!!  Form::select('grade',$parameters['grades'],old('grade',$visitor_details->user->grade ?? $user->grade ?? null),['placeholder'=>'账户级别',"class"=>'checkNull select2',":disabled"=>'user_disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">管理员：</div>
                        <div class="liRight">
                            {!!  Form::select('administrator',$parameters['admins'],old('administrator',$visitor_details->user->administrator ?? $user->administrator ?? auth('admin')->user()->id),['placeholder'=>'管理员',"class"=>'checkNull select2',":disabled"=>'user_disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                        <li>
                            <div class="liLeft">客户行业：</div>
                            <div class="liRight">
                                {!!  Form::select('industry',$parameters['industry'],old('industry',$visitor_details->industry ?? $user->industry ?? null),['placeholder'=>'客户行业',"class"=>'select2',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">客户位置：</div>
                            <div class="liRight">
                                {!!  Form::text('address',old('address',$visitor_details->address ?? $user->address ?? null),['placeholder'=>'客户位置',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">搜索词：</div>
                            <div class="liRight">
                                {!!  Form::text('search',old('search',$visitor_details->search ?? $user->visitor_details->search ?? null),['placeholder'=>'搜索词',"class"=>'',":disabled"=>'visitor_details_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">关键词：</div>
                            <div class="liRight">
                                {!!  Form::text('key',old('key',$visitor_details->key ?? $user->visitor_details->key ?? null),['placeholder'=>'关键词',"class"=>'',":disabled"=>'visitor_details_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">单位简称：</div>
                            <div class="liRight">
                                {!!  Form::text('unit',old('unit',$visitor_details->user->unit ?? $user->unit ?? null),['placeholder'=>'单位简称',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">手机：</div>
                            <div class="liRight">
                                {!!  Form::text('phone',old('phone',$visitor_details->user->phone ?? $user->phone ?? null),['placeholder'=>'手机',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">座机：</div>
                            <div class="liRight">
                                {!!  Form::text('telephone',old('telephone',$visitor_details->user->telephone ?? $user->telephone ?? null),['placeholder'=>'座机',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">邮箱：</div>
                            <div class="liRight">
                                {!!  Form::text('email',old('email',$visitor_details->user->email ?? $user->email ?? null),['placeholder'=>'邮箱',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">QQ：</div>
                            <div class="liRight">
                                {!!  Form::text('qq',old('qq',$visitor_details->user->qq ?? $user->qq ?? null),['placeholder'=>'QQ',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">微信：</div>
                            <div class="liRight">
                                {!!  Form::text('wechat',old('wechat',$visitor_details->user->wechat ?? $user->wechat ?? null),['placeholder'=>'微信',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">账期(天)：</div>
                            <div class="liRight">
                                {!!  Form::text('payment_days',old('payment_days',$visitor_details->user->payment_days  ?? $user->payment_days ?? null),['placeholder'=>'账期',"class"=>'',":disabled"=>'user_disabled']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                    <li class="allLi">
                        <div class="liLeft">咨询筛选：</div>
                        <div class="liRight ">

                            <div class="shaixuanItem">
                                {{ Form::select('filtrate[]',$filtrate->pluck('name','id'),old('filtrate[]',43),['placeholder'=>'请选择一项','class'=>'checkNull select2 filtrate']) }}
                            </div>
                            <div class="shaixuanItem">
                                @foreach($filtrate as $key=>$item)
                                    {{ Form::select('filtrate[]',$item->children->pluck('name','id'),old('filtrate[]'),['placeholder'=>'请选择一项','class'=>'checkNull select2 filtrate']) }}
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="Li50">
                        <div class="liLeft">应用说明：</div>
                        <div class="liRight">
                            {!!  Form::text('explain',old('explain'),['placeholder'=>'筛选不到的特殊说明',"class"=>'']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="Li50">
                        <div class="liLeft">预算范围：</div>
                        <div class="liRight">
                            {!!  Form::text('budget',old('budget'),['placeholder'=>'20000元以内',"class"=>'OneNumber']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                </tab-pane>
                <tab-pane label="用户指定产品" icon="cube">
                    @foreach($parameters['products'] as $key=>$item)
                            <li>
                                <div class="liLeft">{{ $item }}：</div>
                                <div class="liRight">
                                    {!!  Form::text('collocate['.$key.']',old('collocate['.$key.']'),['placeholder'=>'请输入用户指定的 '.$item.' 型号或参数要求',"class"=>'']) !!}
                                </div>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                </tab-pane>
                <tab-pane label="交流记录" icon="social-twitch">
                    <script id="container" name="record"   type="text/plain">
                    </script>
                </tab-pane>
            </Tabs>







</div>






