
<?php $__env->startSection('title',$service_clause->field['name']); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/service_clause.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div class="wrap">
            <div class="PhoneLinks">
                <?php $__currentLoopData = $service_clauses->groupBy('field.type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$clauses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <dl>
                        <dt><?php echo e(config('status.service_directory_type')[$key]); ?></dt>
                        <?php $__empty_1 = true; $__currentLoopData = $clauses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <dd class="<?php echo e($item->id == $service_clause->id ? 'dd2' : ''); ?>"><a href="<?php echo e(route('service_support.service_clause',$item->id)); ?>?status=true"><?php echo e($item->field['name']); ?><i>></i></a></dd>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </dl>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>