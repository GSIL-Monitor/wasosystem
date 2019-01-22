
<?php $__env->startSection('title','首页'); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .share_div{width:0px;height:0px;overflow:hidden;}
    </style>
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/index.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            $('.main_point li').eq(0).addClass("active");
            $('.pic_news li').eq(1).addClass("mid");
            /*  顶部产品  */

            var bodyW = $(window).width();
            if(bodyW>900){
                $(window).scroll(function(){
                    if($(this).scrollTop()>200){
                        $(".indexTopPro").addClass("indexTopProOpen");
                    }
                    else{
                        $(".indexTopPro").removeClass("indexTopProOpen");
                    }
                });
            }
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('site.index.components.indexTopPro', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     <?php echo $__env->make('site.index.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>