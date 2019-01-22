<form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">供货商</th>
            <th class="">关联客户</th>
            <th class="">经办人</th>
            <th class="">采购员</th>
            <th class="">操作员</th>
            <th class="">入库时间</th>
            <th class="">受理时间</th>
        </tr>

        <?php $__empty_1 = true; $__currentLoopData = $barcode_associateds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barcode_associated): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr>
                <td class="">
                    <?php echo e(config('status.barcode_associateds_type')[$barcode_associated->current_state]); ?>

                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                       data_url="<?php echo e(route('admin.barcode_associateds.create')); ?>?status=<?php echo e($barcode_associated->current_state); ?>&id=<?php echo e($barcode_associated->id); ?>&code=<?php echo e($barcode_associated->code); ?>&product_good_id=<?php echo e($barcode_associated->product_good->id); ?>"><?php echo e($barcode_associated->code); ?></a>
                </td>
                <td><?php echo e($barcode_associated->product_good->product->title); ?></td>
                <td><?php echo e($barcode_associated->product_good->name); ?></td>
                <td><?php echo e($barcode_associated->supplier_managements->name ?? ''); ?></td>
                <td><?php echo e($barcode_associated->user->username ?? ''); ?>  <?php echo e($barcode_associated->user->nickname ?? ''); ?></td>
                <td><?php echo e($barcode_associated->order->markets->name ?? $barcode_associated->user->admins->name ?? ''); ?></td>
                <td><?php echo e($barcode_associated->procurement_plans->admins->name ?? ''); ?></td>
                <td><?php echo e($barcode_associated->admins->name ?? ''); ?></td>
                <td class=""><?php echo e($barcode_associated->updated_at->format('Y-m-d') ?? ''); ?></td>
                <td class=""><?php echo e($barcode_associated->updated_at->format('Y-m-d') ?? ''); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        <?php endif; ?>
    </table>
    <?php echo $barcode_associateds->appends(Request::except('page','_token'))->render(); ?>

</form>
