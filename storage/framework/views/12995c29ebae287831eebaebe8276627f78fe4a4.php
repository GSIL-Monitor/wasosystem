
<?php $__env->startSection('title','服务支持'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/service_support.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(".drive_box ul li").eq(1).addClass("midLi");
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.service_supports.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>