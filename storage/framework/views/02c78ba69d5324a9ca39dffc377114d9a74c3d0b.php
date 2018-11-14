
<?php $__env->startSection('title','版权声明'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/copyright.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="body">
        <div class="crumb"><div class="wrap"><a href="/">首页</a> > <span>版权说明</span></div></div>

        <div class="wrap">
            <div class="info_box">
                <h5>版权声明</h5>

                <div class="words">
                    <?php echo $copyright->field['content']; ?>

                </div>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>