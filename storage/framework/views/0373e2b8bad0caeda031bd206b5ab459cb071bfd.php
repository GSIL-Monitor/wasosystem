<div class="lookType">
    <ul class="radiusBtn">
        <?php if(is_array($datas)): ?>
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key == $duiBiCanShu): ?>
                <li class="active"><a href="<?php echo e($url); ?>?<?php echo e($canshu); ?>=<?php echo e($key); ?><?php echo e($link ?? ''); ?>"><?php echo e($data); ?></a></li>
            <?php else: ?>
                <li class=""><a href="<?php echo e($url); ?>?<?php echo e($canshu); ?>=<?php echo e($key); ?><?php echo e($link ?? ''); ?>"><?php echo e($data); ?></a></li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($data->id == $duiBiCanShu): ?>
                    <li class="active"><a href="<?php echo e($url); ?>?<?php echo e($canshu); ?>=<?php echo e($data->id); ?><?php echo e($link ?? ''); ?>"><?php echo e($data->title); ?></a></li>
                <?php else: ?>
                    <li class=""><a href="<?php echo e($url); ?>?<?php echo e($canshu); ?>=<?php echo e($data->id); ?><?php echo e($link ?? ''); ?>"><?php echo e($data->title); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(isset($add)): ?>
                <?php $__currentLoopData = $add; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class=""><a class="changeWeb" data_url="<?php echo e($item['url']); ?>"><?php echo e($item['name']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>