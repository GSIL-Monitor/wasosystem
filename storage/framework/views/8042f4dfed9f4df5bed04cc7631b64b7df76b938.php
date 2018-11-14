
<?php $__env->startSection('title','常用配置'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/person_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/money.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui-1.9.2.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/common_equipments.js')); ?>"></script>
    <script>
        $(function () {


            $(document).ready(function(){
                $("#<?php echo e(Request::get('p') ?? 'log'); ?>").hide().siblings(".PageBox").show();
                $(document).on("click",".PageSelect li",function(){
                    var index = $(this).index();
                    $(this).addClass("active").siblings("li").removeClass("active");
                    $(".MoneyBox .PageBox").eq(index).show().siblings(".PageBox").hide();
                });
            });
            $("#p_header h5").text("资金管理");

        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('member_centers.funds_managements.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>