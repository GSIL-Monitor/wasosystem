<table class="listTable">
    <tr>
        <th class="">发生时间</th>
        <th class="tableInfoDel">事件</th>
        <th class="">所在地</th>
    </tr>

    <?php $__empty_1 = true; $__currentLoopData = $barcode_associateds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barcode_associated): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $types=$barcode_associated->current_state ?? $barcode_associated->procurement_type ?? $barcode_associated->out_type;?>
        <tr>
            <td class=""><?php echo e($barcode_associated->updated_at ?? ''); ?></td>
            <td class="tableInfoDel  tablePhoneShow  tableName">
                <?php if(str_contains($types,['procurement','test'])): ?>
                    <?php $url=route('admin.put_in_storage_managements.edit',$barcode_associated->id);?>
                <?php elseif(in_array($types,['sell','loan_out'])): ?>
                    <?php $url=route('admin.warehouse_out_managements.edit',$barcode_associated->id);?>
                <?php else: ?>
                    <?php $url=route('admin.barcode_associateds.create').'?category='.$barcode_associated->type.'&status='.$types.'&id='.$barcode_associated->id.'&code='.$barcode_associated->code.'&product_good_id='.$barcode_associated->product_good->id.'&search=search';?>
                <?php endif; ?>
                <a class="changeWeb" data_url="<?php echo e($url); ?>">
                    <?php echo e(config('status.barcode_associateds_type')[$types]); ?> <?php echo e($types); ?>

                </a>
            </td>
            <td>
                <?php if(isset($barcode_associated->location) && $barcode_associated->location =='库存' || in_array($types,['procurement','test'])): ?>
                    库存
               <?php endif; ?>
               <?php if(isset($barcode_associated->location) && $barcode_associated->location =='客户' || in_array($types,['sell','loan_out'])): ?>
                        <?php echo e($barcode_associated->user->username); ?>   <?php echo e($barcode_associated->user->nickname); ?>

               <?php endif; ?>
               <?php if(isset($barcode_associated->location) && $barcode_associated->location =='代管'): ?>
                    代管
               <?php endif; ?>
               <?php if(isset($barcode_associated->location) && $barcode_associated->location =='供货商'): ?>
                        <?php echo e($barcode_associated->supplier_managements->code); ?>  <?php echo e($barcode_associated->supplier_managements->name); ?>

               <?php endif; ?>
               <span class="redWord"><?php echo e($barcode_associated->description); ?></span>
                    <?php echo e($barcode_associated->user_id ?? 0); ?>

                    <?php echo e($barcode_associated->order->id ?? 0); ?>


            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan='3'><div class='error'>没有数据</div></td></tr>
    <?php endif; ?>
</table>
