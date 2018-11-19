<?php $__currentLoopData = config('site.member_center_links'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <dl>
        <dt><?php echo e($title); ?></dt>
        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(user()->parts_buy && $url== 'parts_buy.index'): ?>
                <dd><a href="<?php echo e(route($url)); ?>" class="<?php if(Route::is($url)): ?> active <?php endif; ?>"><?php echo e($value['name']); ?></a><img src="<?php echo e(config('site.member_center_links_pic')); ?>"></dd>
                <?php else: ?>
                <dd><a href="<?php if(Route::has($url)): ?> <?php echo e(route($url)); ?>  <?php endif; ?>" class="<?php if(Route::is($url)): ?> active <?php endif; ?>"><?php echo e($value['name']); ?></a><img src="<?php echo e(config('site.member_center_links_pic')); ?>"></dd>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </dl>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
