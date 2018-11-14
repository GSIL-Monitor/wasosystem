<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.members.create'))
            {!! Form::open(['route'=>'admin.members.store','method'=>'post','id'=>'members','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($member,['route'=>['admin.members.update',$member->id],'id'=>'members','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">账号：</div>
                <div class="liRight">
                    {!!  Form::text('username',old('username'),['placeholder'=>'请输入账号',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">手机：</div>
                <div class="liRight">
                    {!!  Form::text('phone',old('phone'),['placeholder'=>'请输入手机',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">邮箱：</div>
                <div class="liRight">
                    {!!  Form::email('email',old('email'),['placeholder'=>'请输入邮箱',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">密码：</div>
                <div class="liRight">
                    @if(Route::is('admin.members.create'))
                    {!!  Form::password('password',old('password'),['placeholder'=>'请输入密码',"class"=>'checkNull']) !!}
                    @else
                    {!!  Form::password('password',old('password'),['placeholder'=>'为空则不修改',"class"=>'']) !!}
                    @endif
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">姓名：</div>
                <div class="liRight">
                    {!!  Form::text('nickname',old('nickname'),['placeholder'=>'姓名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位简称：</div>
                <div class="liRight">
                    {!!  Form::text('unit',old('unit'),['placeholder'=>'单位简称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">账户级别：</div>
                <div class="liRight">
                    {!!  Form::select('grade',$parameters['grades'],old('grade'),['placeholder'=>'账户级别',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">管理员：</div>
                <div class="liRight">
                    {!!  Form::select('administrator',$parameters['admins'],old('administrator'),['placeholder'=>'管理员',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">会员税率：</div>
                <div class="liRight">
                    {!!  Form::select('tax_rate',$parameters['tax_rate'],old('tax_rate'),['placeholder'=>'会员税率',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">信息接收：</div>
                <div class="liRight">
                    {!!  Form::select('tax_rate',$parameters['message_type'],old('tax_rate'),['placeholder'=>'信息接收',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户行业：</div>
                <div class="liRight">
                    {!!  Form::select('industry',$parameters['industry'],old('industry'),['placeholder'=>'客户行业',"class"=>'select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户位置：</div>
                <div class="liRight">
                    {!!  Form::text('address',old('address'),['placeholder'=>'客户行业',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">QQ：</div>
                <div class="liRight">
                    {!!  Form::text('qq',old('qq'),['placeholder'=>'QQ',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">微信：</div>
                <div class="liRight">
                    {!!  Form::text('wechat',old('wechat'),['placeholder'=>'微信',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">座机：</div>
                <div class="liRight">
                    {!!  Form::text('telephone',old('telephone'),['placeholder'=>'座机',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">账期(天)：</div>
                <div class="liRight">
                    {!!  Form::text('payment_days',old('payment_days'),['placeholder'=>'账期',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>


        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


