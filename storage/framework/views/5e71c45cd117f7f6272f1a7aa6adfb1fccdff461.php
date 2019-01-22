<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.services.create')): ?>
            <?php echo Form::open(['route'=>'admin.services.store','method'=>'post','id'=>'services','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($service,['route'=>['admin.services.update',$service->id],'id'=>'services','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">质保单号：</div>
                <div class="liRight">
                    <?php echo Form::text('serial_number',old('serial_number',optional($service)->serial_number ?? 'ZB'.date('YmdHis',time())),['placeholder'=>'质保单号',"class"=>'checkNull','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户信息：</div>
                <div class="liRight">
                    <?php echo Form::text('username',old('username',optional($order)->user->username ?? optional($service)->username ?? ''),['placeholder'=>'客户信息',"class"=>'',':disabled'=>'disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">申报单号：</div>
                <div class="liRight">
                    <?php echo Form::text('order_serial_number',old('order_serial_number',optional($order)->serial_number ?? optional($service)->order_serial_number ?? ''),['placeholder'=>'申报单号',"class"=>'',':disabled'=>'disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保模式：</div>
                <div class="liRight">
                    <?php echo Form::select('quality_assurance_model',config('status.service_quality_assurance_model'),old('quality_assurance_model'),['placeholder'=>'申报单号',"class"=>'select2 checkNull quality_assurance_model',':disabled'=>'disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">故障描述：</div>
                <div class="liRight">
                    <?php echo Form::textarea('error_description',old('error_description'),['placeholder'=>'故障描述',"class"=>'checkNull',':disabled'=>'disabled']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <?php if(!empty($order) && !empty($order->warehouseOut->codes)): ?>
            <li class="sevenLi">
                <div class="liLeft">订单列表：</div>
                <div class="liRight" >
                    <table class="listTable">
                        <tr>
                            <th class="">类型</th>
                            <th class="tableInfoDel">名称</th>
                            <th class="">数量</th>
                            <th class=""><input type="checkbox" class="selectBox SelectAll"> 条码</th>
                            <th class="">质保时间</th>
                        </tr>
                        <?php $order_product_goods=$order->order_product_goods()->orderBy('product_number','asc')->get();
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="">
                                    <?php echo e($product_good->product->title); ?>&nbsp;&nbsp;
                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    <?php echo e($product_good->name); ?>

                                </td>
                                <td class="num">
                                    <?php echo e($product_good->pivot->product_good_num / $order->num); ?>

                                </td>
                                    <td class="">
                                        <?php $__currentLoopData = $order->warehouseOut->codes[$loop->index]->code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($service): ?>
                                                <?php if(!empty($service->product_goods[$product_good->id])): ?>
                                                    <?php  $checked=str_contains($item,$service->product_goods[$product_good->id]) ? 'checked' : ''; ?>
                                                    <?php else: ?>
                                                    <?php  $checked=str_contains($item,$service->product_goods) ? 'checked' : ''; ?>
                                                 <?php endif; ?>
                                            <?php else: ?>
                                                <?php $checked='';?>
                                            <?php endif; ?>
                                            <label for=""><input :disabled="disabled" class="selectBox selectIds" <?php echo e($checked); ?> type="checkbox" name="product_goods[<?php echo e($product_good->id); ?>][]" value="<?php echo e($item); ?>"> <?php echo e($item); ?></label><br/>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                <td>
                                    <?php echo e($product_good->quality_time); ?>/<?php echo e($product_good->getQualityTime($order->created_at)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6"><div class="empty">没有数据</div></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="clear"></div>
            </li>
            <?php endif; ?>
            <li>
                <div class="liLeft">上门时间：</div>
                <div class="liRight">
                    <template>
                        <date-picker type="datetime" :value="date"  placeholder="请选择预约上门时间"  name="door_of_time" large transfer></date-picker>
                    </template>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">上门人员：</div>
                <div class="liRight">
                    <?php echo Form::select('door_and_service_staff[door][]',$admins,old('door_and_service_staff[door][]'),["class"=>'select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务人员：</div>
                <div class="liRight">
                    <?php echo Form::select('door_and_service_staff[service][]',$admins,old('door_and_service_staff[service][]',array_unique(array_filter(array_flatten(array_merge(optional($order)->participation_admin ?? [],[optional($order)->market]))))),["class"=>'select2 checkNull','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保状态：</div>
                <div class="liRight">
                    <?php echo Form::select('quality_assurance_status',config('status.service_quality_assurance_status'),old('quality_assurance_status'),["class"=>'select2 checkNull','placeholder'=>'请选择质保状态']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务事件：</div>
                <div class="liRight">
                    <?php $__currentLoopData = config('status.service_quality_assurance_event'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label for="event<?php echo e($key); ?>">
                                <?php echo e(Form::radio('service_event',$key,old('service_event'),['id'=>'event'.$key])); ?> <?php echo e($item); ?>

                        </label><br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">解决办法：</div>
                <div class="liRight">
                    <?php echo Form::textarea('solution',old('solution'),['placeholder'=>'解决办法',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <?php if(!Route::is('admin.services.create')): ?>
            <li>
                <div class="liLeft">导出表格：</div>
                <div class="liRight">
                    <a href="<?php echo e(route('admin.services.export',$service->id)); ?>">【质保受理单】</a>
                </div>
                <div class="clear"></div>
            </li>
            <?php endif; ?>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


