<form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">关联客户</th>
            <th class="">经办人</th>
            <th class="">操作员</th>
            <th class="">借出时间</th>

        </tr>

        <?php $__empty_1 = true; $__currentLoopData = $barcode_associateds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$barcode_associated): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr>
                <td class="">
                 借出
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                       data_url="<?php echo e(route('admin.barcode_associateds.create')); ?>?status=<?php echo e($barcode_associated['barcode_associateds']->out_type); ?>&id=<?php echo e($barcode_associated['barcode_associateds']->id); ?><?php echo e(array_to_url(array_except($barcode_associated,'barcode_associateds'))); ?>"><?php echo e($key); ?></a>
                </td>
                <td><?php echo e($barcode_associated['product_good_type']); ?></td>
                <td><?php echo e($barcode_associated['product_good_name']); ?></td>
                <td><?php echo e($barcode_associated['barcode_associateds']->user->username ?? $barcode_associated['barcode_associateds']->admins->name); ?></td>

                <td><?php echo e($barcode_associated['barcode_associateds']->order->markets->name  ?? $barcode_associated['barcode_associateds']->user->admins->name); ?></td>
                <td><?php echo e($barcode_associated['barcode_associateds']->admins->name); ?></td>
                <td class=""><?php echo e($barcode_associated['barcode_associateds']->updated_at->format('Y-m-d')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        <?php endif; ?>
    </table>
</form>