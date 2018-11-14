
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="warehouse_out_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">序列号</th>
                    <th class="">型号</th>
                    <th class="">收货单位</th>
                    <th class="">数量</th>
                    <th class="">经办人</th>
                    <th class="">下单时间</th>
                    <th class="">操作</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $out_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $out_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(!$out_order->warehouse_out): ?>
                <tr>
                    <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                           data_url="<?php echo e(route('admin.warehouse_out_managements.create')); ?>?id=<?php echo e($out_order->id); ?>"><?php echo e($out_order->serial_number); ?></a>
                    </td>
                    <td><?php echo e($out_order->machine_model ?? ''); ?></td>
                    <td><?php echo e($out_order->user->username.' -  '.$out_order->user->nickname); ?></td>
                    <td><?php echo e($out_order->order_product_goods->sum('pivot.product_good_num')); ?></td>
                    <td><?php echo e($out_order->markets->name ?? ''); ?></td>
                    <td class=""><?php echo e($out_order->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <?php if($out_order->order_type !='parts' && str_contains($warehouse_out_model, substr($out_order->machine_model,0,3))): ?>
                            <a data_url="<?php echo e(route('admin.warehouse_out_managements.inventory_machine')); ?>?id=<?php echo e($out_order->id); ?>" class="changeWeb">调用库存整机</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
         <tr><td><div class='error'>没有数据</div></td></tr>
    <?php endif; ?>
</table>
</form>
<?php echo $out_orders->appends(Request::all())->render(); ?>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>