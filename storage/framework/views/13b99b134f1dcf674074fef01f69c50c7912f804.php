
<?php $__env->startSection('title','服务器三大件性价比指数表'); ?>
<?php $__env->startSection('css'); ?>

    <link href="<?php echo e(asset('css/three_major_items.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/three_easy.js')); ?>"></script>
    <script>
        var order_url="<?php echo e(route('three_major_items.order')); ?>";
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.model_selections.body.three_major_items_body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>