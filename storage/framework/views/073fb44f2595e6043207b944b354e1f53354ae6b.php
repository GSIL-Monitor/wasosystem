
<?php $__env->startSection('title','我的订单'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/order.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/orderAll.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-ui-1.9.2.custom.js')); ?>"></script>
    <script>
        $(function () {
            $(".search_btn").click(function(){
                $('#orders').submit();
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.orders.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>