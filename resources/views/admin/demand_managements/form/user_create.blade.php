
<fieldset>
    <legend>客户信息采集</legend>
    <li>
        <div class="liLeft">需求号：</div>
        <div class="liRight">
            {!!  Form::text('demand_number',old('demand_number','SN'.date('YmdHis'),time()),['placeholder'=>'需求号',"class"=>'','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">账号：</div>
        <div class="liRight">
            {!!  Form::text('username',old('username',$user->username),['placeholder'=>'账号',"class"=>'checkNull','disabled']) !!}
        </div>
        <div class="clear"></div>
    </li>

    <li>
        <div class="liLeft">客户名称：</div>
        <div class="liRight">
            {!!  Form::text('nickname',old('nickname',$user->nickname ?? null),['placeholder'=>'客户名称',"class"=>'checkNull','disabled']) !!}
        </div>
        <div class="clear"></div>
    </li>

    <li>
        <div class="liLeft">认证级别：</div>
        <div class="liRight">
            {!!  Form::select('grade',$parameters['grades'],old('grade',$user->grade),['placeholder'=>'账户级别',"class"=>'checkNull select2','disabled']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">管理员：</div>
        <div class="liRight">
            {!!  Form::select('administrator',$parameters['admins'],old('administrator',$user->administrator ?? auth('admin')->user()->id),['placeholder'=>'管理员',"class"=>'checkNull select2','disabled']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <div class="hideBox">

        <li>
            <div class="liLeft">客户行业：</div>
            <div class="liRight">
                {!!  Form::select('industry',$parameters['industry'],old('industry',$user->industry),['placeholder'=>'客户行业',"class"=>'select2','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">客户位置：</div>
            <div class="liRight">
                {!!  Form::text('address',old('address',$user->address),['placeholder'=>'客户位置',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">单位简称：</div>
            <div class="liRight">
                {!!  Form::text('unit',old('unit',$user->unit),['placeholder'=>'单位简称',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">手机：</div>
            <div class="liRight">
                {!!  Form::text('phone',old('phone',$user->phone),['placeholder'=>'手机',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">座机：</div>
            <div class="liRight">
                {!!  Form::text('telephone',old('telephone',$user->telephone),['placeholder'=>'座机',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">邮箱：</div>
            <div class="liRight">
                {!!  Form::text('email',old('email',$user->email),['placeholder'=>'邮箱',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">QQ：</div>
            <div class="liRight">
                {!!  Form::text('qq',old('qq',$user->qq),['placeholder'=>'QQ',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">微信：</div>
            <div class="liRight">
                {!!  Form::text('wechat',old('wechat',$user->wechat),['placeholder'=>'微信',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>

        <li>
            <div class="liLeft">账期(天)：</div>
            <div class="liRight">
                {!!  Form::text('payment_days',old('payment_days',$user->payment_days),['placeholder'=>'账期',"class"=>'','disabled']) !!}
            </div>
            <div class="clear"></div>
        </li>
    </div>
    <div class="hideBox_showBtn hideBox_Btn"><span></span></div>
</fieldset>
<fieldset>
    <legend>咨询筛选</legend>
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
</fieldset>
<fieldset>
    <legend>应用说明</legend>

    <li>
        <div class="liLeft">应用说明：</div>
        <div class="liRight">
            {!!  Form::text('explain',old('explain'),['placeholder'=>'筛选不到的特殊说明',"class"=>'']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">预算范围：</div>
        <div class="liRight">
            {!!  Form::number('budget',old('budget'),['placeholder'=>'20000元以内',"class"=>'']) !!}
        </div>
        <div class="clear"></div>
    </li>
</fieldset>
<fieldset>
    <legend>用户指定</legend>

    @foreach($parameters['products'] as $key=>$item)
        @if($loop->index <=1)
            <li>
                <div class="liLeft">{{ $item }}：</div>
                <div class="liRight">
                    {!!  Form::text('collocate['.$key.']',old('collocate['.$key.']'),['placeholder'=>'请输入用户指定的 '.$item.' 型号或参数要求',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
        @endif
    @endforeach
    <div class="hideBox">
        @foreach($parameters['products'] as $key=>$item)
            @if($loop->index >=2)
                <li>
                    <div class="liLeft">{{ $item }}：</div>
                    <div class="liRight">
                        {!!  Form::text('collocate['.$key.']',old('collocate['.$key.']'),['placeholder'=>'请输入用户指定的 '.$item.' 型号或参数要求',"class"=>'']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
            @endif
        @endforeach
    </div>
    <div class="hideBox_showBtn hideBox_Btn"><span></span></div>
</fieldset>
<fieldset>
    <legend>交流记录</legend>
    @include('vendor.ueditor.assets')
    <script id="container" name="record"   type="text/plain">
    </script>
</fieldset>
