
<?php $__env->startSection('title','IT服务外包'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/product_list.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/it_outsourcings.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/designer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/it_outsourcings.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.it_outsourcings.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>