
<?php $__env->startSection('title','企业信息'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/address.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/address.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.user_companies.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>