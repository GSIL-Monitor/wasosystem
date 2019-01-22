<div class="zyw">
    <div class="zyw_left" id="app">
        <ul class="zywUl">
            <Tabs>
                <tab-pane label="客户客情信息" icon="android-contact">
                    <li class="allLi">
                        <div class="liLeft">关联订单：</div>
                        <div class="liRight">
                            <?php echo Form::hidden(null,$demand_management_order->implode('id',','),['placeholder'=>'关联订单',"class"=>'','readonly']); ?>

                            <table class="listTable">
                                <tr>
                                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                                    <th class="tableInfoDel">序列号</th>
                                    <th class="">类型</th>
                                    <th class="">状态</th>
                                    <th class="">型号</th>
                                    <th class="">金额</th>

                                </tr>
                                <?php $__empty_1 = true; $__currentLoopData = $demand_management_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="tableInfoDel">
                                            <input class="selectBox selectIds" type="checkbox" name="id[]"
                                                   value="<?php echo e($item->id); ?>">
                                        </td>
                                        <td class="tableInfoDel  tablePhoneShow  tableName">
                                            <a class="changeWeb" data_url="<?php echo e(route('admin.orders.edit',$item->id)); ?>">
                                                <?php echo e($item->serial_number); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e(str_limit($parameters['order_type'][$item->order_type],4)); ?></td>
                                        <td><?php echo e($parameters['order_status'][$item->order_status]); ?></td>
                                        <td><?php echo e($item->machine_model); ?></td>
                                        <td><?php echo e($item->total_prices); ?>元</td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p>
                                        没有订单
                                    </p>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">客户状态：</div>
                        <div class="liRight">
                            <?php echo Form::select('customer_status',$parameters['customer_status'],old('customer_status'),['placeholder'=>'客户状态',"class"=>'checkNull','readonly']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">下一计划：</div>
                        <div class="liRight">
                            <?php echo Form::text('the_next_step_program',old('the_next_step_program'),['placeholder'=>'下一步计划',"class"=>'checkNull']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">模拟数据：</div>
                        <div class="liRight">
                            <?php echo Form::checkbox('analog_data',$demand_management->analog_data ?? 0,old('analog_data'),["class"=>'checkNull radio']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">咨询筛选：</div>
                        <div class="liRight ">
                            <?php if($demand_management_filtrate->isNotEmpty()): ?>
                                <?php $filtrateList=$DemandManagementParamenter->filtrateList($demand_management_filtrate);

                                ?>
                                <?php $__currentLoopData = $filtrateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="shaixuanItem">
                                        <?php echo e(Form::select('filtrate[]',$item,old('filtrate[]',$key),['placeholder'=>'请选择一项','class'=>'checkNull select2 filtrate'])); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="shaixuanItem">
                                    <?php echo e(Form::select('filtrate[]',$filtrate->pluck('name','id'),old('filtrate[]',43),['placeholder'=>'请选择一项','class'=>'checkNull select2 filtrate'])); ?>

                                </div>
                                <div class="shaixuanItem">
                                    <?php $__currentLoopData = $filtrate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(Form::select('filtrate[]',$item->children->pluck('name','id'),old('filtrate[]'),['placeholder'=>'请选择一项','class'=>'checkNull select2 filtrate'])); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">协同帮助：</div>
                        <div class="liRight">
                            <?php echo Form::select('assistant[]',$parameters['admins'],old('assistant[]'),["class"=>'checkNull select2','multiple']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">需求号：</div>
                        <div class="liRight">
                            <?php echo Form::text('demand_number',old('demand_number'),['placeholder'=>'需求号',"class"=>'','readonly']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">账号：</div>
                        <div class="liRight">
                            <?php echo Form::text('username',old('username',$demand_management->user->username ?? null),['placeholder'=>'账号',"class"=>'','disabled']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <div class="hideBox">
                        <li>
                            <div class="liLeft">访问时间：</div>
                            <div class="liRight">
                                <?php echo Form::text('serial_number',old('serial_number',$demand_management->created_at ??  date('Y-m-d H:i:s',time())),['placeholder'=>'访问时间',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">客户名称：</div>
                            <div class="liRight">
                                <?php echo Form::text('nickname',old('nickname',$demand_management->user->nickname ?? null),['placeholder'=>'客户名称',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">客户来源：</div>
                            <div class="liRight">
                                <?php echo Form::select('source',$parameters['source'],old('source',$visitor_details->source ?? null),['placeholder'=>'客户来源',"class"=>' select2','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">认证级别：</div>
                            <div class="liRight">
                                <?php echo Form::select('grade',$parameters['grades'],old('grade',$demand_management->user->grade ?? null),['placeholder'=>'账户级别',"class"=>' select2','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">管理员：</div>
                            <div class="liRight">
                                <?php echo Form::select('administrator',$parameters['admins'],old('administrator',$demand_management->user->administrator ?? auth('admin')->user()->id),['placeholder'=>'管理员',"class"=>' select2','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>

                        <li>
                            <div class="liLeft">客户行业：</div>
                            <div class="liRight">
                                <?php echo Form::select('industry',$parameters['industry'],old('industry',$visitor_details->industry ?? null),['placeholder'=>'客户行业',"class"=>'select2','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">客户位置：</div>
                            <div class="liRight">
                                <?php echo Form::text('address',old('address',$visitor_details->address ?? null),['placeholder'=>'客户位置',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">搜索词：</div>
                            <div class="liRight">
                                <?php echo Form::text('search',old('search',$visitor_details->search ?? null),['placeholder'=>'搜索词',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">关键词：</div>
                            <div class="liRight">
                                <?php echo Form::text('key',old('key',$visitor_details->key ?? null),['placeholder'=>'关键词',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">单位简称：</div>
                            <div class="liRight">
                                <?php echo Form::text('unit',old('unit',$demand_management->user->unit ?? null),['placeholder'=>'单位简称',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">手机：</div>
                            <div class="liRight">
                                <?php echo Form::text('phone',old('phone',$demand_management->user->phone ?? null),['placeholder'=>'手机',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">座机：</div>
                            <div class="liRight">
                                <?php echo Form::text('telephone',old('telephone',$demand_management->user->telephone ?? null),['placeholder'=>'座机',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">邮箱：</div>
                            <div class="liRight">
                                <?php echo Form::text('email',old('email',$demand_management->user->email ?? null),['placeholder'=>'邮箱',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">QQ：</div>
                            <div class="liRight">
                                <?php echo Form::text('qq',old('qq',$demand_management->user->qq ?? null),['placeholder'=>'QQ',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">微信：</div>
                            <div class="liRight">
                                <?php echo Form::text('wechat',old('wechat',$demand_management->user->wechat ?? null),['placeholder'=>'微信',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>

                        <li>
                            <div class="liLeft">账期(天)：</div>
                            <div class="liRight">
                                <?php echo Form::text('payment_days',old('payment_days',$demand_management->user->payment_days ?? null),['placeholder'=>'账期',"class"=>'','disabled']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                    </div>
                    <div class="hideBox_showBtn hideBox_Btn"><span></span></div>

                    <li class="Li50">
                        <div class="liLeft">应用说明：</div>
                        <div class="liRight">
                            <?php echo Form::text('explain',old('explain'),['placeholder'=>'筛选不到的特殊说明',"class"=>'']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="Li50">
                        <div class="liLeft">预算范围：</div>
                        <div class="liRight">
                            <?php echo Form::text('budget',old('budget'),['placeholder'=>'20000元以内',"class"=>'OneNumber']); ?>

                        </div>
                        <div class="clear"></div>
                    </li>
                </tab-pane>
                <tab-pane label="用户指定产品" icon="cube">
                    <?php $__currentLoopData = $parameters['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="liLeft"><?php echo e($item); ?>：</div>
                            <div class="liRight">
                                <?php echo Form::text('collocate['.$key.']',old('collocate['.$key.']'),['placeholder'=>'请输入用户指定的 '.$item.' 型号或参数要求',"class"=>'']); ?>

                            </div>
                            <div class="clear"></div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tab-pane>
                <tab-pane label="交流记录" icon="social-twitch">
                    <script id="container" name="record" type="text/plain">
                        <?php if(!Route::is('admin.demand_managements.create')): ?>
                            <?php echo $demand_management->record; ?>

                        <?php endif; ?>
                    </script>
                </tab-pane>
            </Tabs>


    </div>




