<?php if(auth()->guard('user')->check()): ?>
<div class="sale_records" name="sale_records" <?php if($sales_records->isEmpty()): ?>style="display: none" <?php endif; ?>>
    <div class="wrap">
        <h6 class="tit">销售记录（<?php echo e($sales_srecord_count); ?>）</h6>
        <ul>
            <?php $__currentLoopData = $sales_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sales_record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <span class="name">会员名称：<?php echo e(RandomName($sales_record->user->username)); ?> </span>
                    <span class="model">型号：<?php echo e($sales_record->machine_model); ?></span>
                    <span class="num">购买数量：<?php echo e($sales_record->num); ?></span>
                    <span class="time">购买时间：<?php echo e($sales_record->created_at->format('Y-m-d')); ?></span>
                    <div class="clear"></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="clear"></div>
        </ul>
    </div>
</div>
    <?php endif; ?>