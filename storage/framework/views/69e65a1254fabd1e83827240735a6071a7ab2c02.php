
<?php $__env->startSection('title','加入我们'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/job.css')); ?>">
    <style>
        .body .jobs .del_through span{
            color:#cccccc;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function(){
            $(".job_type li:nth-child(3n)").addClass("lastLi");
            $('.job_type li').on("click",function(){
                $(this).addClass("li2").siblings("li").removeClass("li2");
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.jobs.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>