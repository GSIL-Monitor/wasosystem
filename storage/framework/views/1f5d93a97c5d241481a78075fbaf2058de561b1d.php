
<?php $__env->startSection('title','个人信息'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/selfs.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/timer.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $(document).on("click","label",function(){
                $(this).addClass("check").children("input").attr("checked","checked");
                $(this).siblings("label").removeClass("check").children("input").attr("checked",false);
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.personal_details.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>