<div class="JJList">
    <?php $OldOrderParamenterPresenter = app('App\Presenters\OldOrderParamenterPresenter'); ?>
    <?php $goods=$OldOrderParamenterPresenter->get_goods($old_order);?>
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.old_orders.create')): ?>
            <?php echo Form::open(['route'=>'admin.old_orders.store','method'=>'post','id'=>'old_orders','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($old_order,['route'=>['admin.old_orders.update',$old_order->id],'id'=>'old_orders','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
        <li>
            <div class="liLeft">订单序列号：</div>
            <div class="liRight">
                <?php echo Form::text('proid',old('proid'),['placeholder'=>'订单序列号',"class"=>'','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">客户账号：</div>
            <div class="liRight">
                <?php echo Form::text('userid',old('userid'),['placeholder'=>'客户账号',"class"=>'','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li class="sevenLi">
            <div class="liLeft">订单列表：</div>
            <div class="liRight">
                <table class="listTable">
                    <tr>
                        <th>类型</th>
                        <th class="tableInfoDel">产品规格及参数</th>
                        <th>数量(个)</th>
                        <th>质保时间</th>
                    </tr>
                    <?php if($old_order->mode == '选购配件'): ?>
                        <?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $gd=explode(',',$good[0]);?>
                            <?php if($key == '硬盘'): ?>
                                <?php $__currentLoopData = $good; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $disk=explode(',',$g); ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$disk[0],'good_num'=>$disk[1],'good_time'=>$disk[2] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif($key == '其他'): ?>
                                <?php $__currentLoopData = $good; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $qita=explode(',',$g); ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$qita[0],'good_num'=>$qita[1],'good_time'=>$qita[2] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                                <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$gd[0],'good_num'=>$gd[1],'good_time'=>$gd[2] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td>产品型号</td>
                            <td colspan="3"><?php echo e($old_order->S_name); ?></td>
                        </tr>
                        <?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $gd=is_string($good) ? explode(',',$good):$good;?>
                            <?php if($key == '硬盘'): ?>
                                <?php $__currentLoopData = $gd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $disk=explode(',',$g); ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$disk[0].'|'.$disk[2].'|'.$disk[3],'good_num'=>$disk[1],'good_time'=>$disk[4] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif($key == '其他'): ?>
                                <?php $__currentLoopData = $gd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $qita=explode(',',$g); ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$qita[0],'good_num'=>$qita[1],'good_time'=>$qita[2] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif($key == '阵列卡'): ?>
                                <?php $__currentLoopData = $gd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $raid=explode(',',$g);  ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$raid[0],'good_num'=>$raid[1],'good_time'=>'0'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                    <?php echo $__env->make('admin.old_orders.old_good',['good_type'=>$key,'good_name'=>$gd[0],'good_num'=>$gd[1],'good_time'=>$gd[2] ?? 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">订单金额：</div>
                <div class="liRight">
                    <?php echo Form::text('all_price',old('all_price'),['placeholder'=>'订单金额',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单数量：</div>
                <div class="liRight">
                    <?php echo Form::text('totalnum',old('totalnum'),['placeholder'=>'订单金额',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">总金额：</div>
                <div class="liRight">
                    <?php echo Form::text('totalprice',old('totalprice'),['placeholder'=>'总金额',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务模式：</div>
                <div class="liRight">
                    <?php echo Form::text('zbmode',old('zbmode',$services[$old_order->zbmode ?? 0]),['placeholder'=>'服务模式',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">款项状态：</div>
                <div class="liRight">
                    <?php echo Form::text('prostatuss',old('prostatuss',config('status.old_fund')[$old_order->prostatuss]),['placeholder'=>'款项状态',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单状态：</div>
                <div class="liRight">
                    <?php echo Form::text('prostatus',old('prostatus',config('status.old_status')[$old_order->prostatus]),['placeholder'=>'订单状态',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">物流信息：</div>
                <div class="liRight">
                    <?php echo Form::text('prowlinfo',old('prowlinfo'),['placeholder'=>'物流信息',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">物流件数：</div>
                <div class="liRight">
                    <?php echo Form::text('wlnum',old('wlnum'),['placeholder'=>'物流件数',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单要求：</div>
                <div class="liRight">
                    <?php echo Form::textarea('beizhu',old('beizhu'),['placeholder'=>'订单要求',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">订单备注：</div>
                <div class="liRight">
                    <?php echo Form::textarea('proremark',old('proremark'),['placeholder'=>'订单备注',"class"=>'','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


