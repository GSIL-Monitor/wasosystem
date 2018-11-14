<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.users.create')): ?>
            <?php echo Form::open(['route'=>'admin.users.store','method'=>'post','id'=>'users','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($user,['route'=>['admin.users.update',$user->id],'id'=>'users','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">账号：</div>
                <div class="liRight">
                    <?php echo Form::text('username',old('username'),['placeholder'=>'请输入账号',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">手机：</div>
                <div class="liRight">
                    <?php echo Form::text('phone',old('phone'),['placeholder'=>'请输入手机',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">邮箱：</div>
                <div class="liRight">
                    <?php echo Form::email('email',old('email'),['placeholder'=>'请输入邮箱',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">密码：</div>
                <div class="liRight">
                    <?php if(Route::is('admin.users.create')): ?>
                        <?php echo Form::text('password',old('password'),['placeholder'=>'请输入密码',"class"=>'checkNull']); ?>

                    <?php else: ?>
                        <?php echo Form::text('password',old('password',''),['placeholder'=>'为空则不修改',"class"=>'']); ?>

                    <?php endif; ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">姓名：</div>
                <div class="liRight">
                    <?php echo Form::text('nickname',old('nickname'),['placeholder'=>'姓名',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">单位简称：</div>
                <div class="liRight">
                    <?php echo Form::text('unit',old('unit'),['placeholder'=>'单位简称',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">账户级别：</div>
                <div class="liRight">
                    <?php echo Form::select('grade',$parameters['grades'],old('grade'),['placeholder'=>'账户级别',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">管理员：</div>
                <div class="liRight">
                    <?php echo Form::select('administrator',$parameters['admins'],old('administrator'),['placeholder'=>'管理员',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">会员税率：</div>
                <div class="liRight">
                    <?php echo Form::select('tax_rate',$parameters['tax_rate'],old('tax_rate'),['placeholder'=>'会员税率',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">信息接收：</div>
                <div class="liRight">
                    <?php echo Form::select('message_type',$parameters['message_type'],old('tax_rate'),['placeholder'=>'信息接收',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户行业：</div>
                <div class="liRight">
                    <?php echo Form::select('industry',$parameters['industry'],old('industry'),['placeholder'=>'客户行业',"class"=>'select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户位置：</div>
                <div class="liRight">
                    <?php echo Form::text('address',old('address'),['placeholder'=>'客户位置',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">QQ：</div>
                <div class="liRight">
                    <?php echo Form::text('qq',old('qq'),['placeholder'=>'QQ',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">微信：</div>
                <div class="liRight">
                    <?php echo Form::text('wechat',old('wechat'),['placeholder'=>'微信',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">座机：</div>
                <div class="liRight">
                    <?php echo Form::text('telephone',old('telephone'),['placeholder'=>'座机',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">账期(天)：</div>
                <div class="liRight">
                    <?php echo Form::text('payment_days',old('payment_days'),['placeholder'=>'账期',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


