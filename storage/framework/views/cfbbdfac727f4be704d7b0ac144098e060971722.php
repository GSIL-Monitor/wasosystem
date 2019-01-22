
<?php $__env->startSection('title','深度定制'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/product_list.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/in_depth_customizations.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/designer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/deep.js')); ?>"></script>
    <script>
        $(function(){
            $("#header .wrap").addClass("noBg");
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.in_depth_customizations.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>