
<?php $__env->startSection('title','个人中心'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>