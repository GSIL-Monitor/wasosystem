
<?php $__env->startSection('title','解决方案'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/solution.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/solution.js')); ?>"></script>
    <script>
        $(".solutionType li:nth-child(3n)").addClass("lastLi");
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.solutions.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>