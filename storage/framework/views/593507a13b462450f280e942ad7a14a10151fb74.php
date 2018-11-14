
<?php $__env->startSection('title','常用配置'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/order.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/orderAll.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui-1.9.2.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/common_equipments.js')); ?>"></script>
    <script>
        $(function () {
            $(".PZList li:even").addClass("leftLi");
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.common_equipments.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>