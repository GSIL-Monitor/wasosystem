
<?php $__env->startSection('title','关于我们'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/about.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/about.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 关于我们 > 公司介绍</div></div>
        <div class="wrap">
            <div class="aboutBox">
                <?php if ($__env->exists('site.abouts.about_link')) echo $__env->make('site.abouts.about_link', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="tab_box">
                    <div class="aboutPic"><img src="<?php echo e(asset('pic/about1.jpg')); ?>"></div>
                    <div class="about_box">
                        <div class="us"><?php echo optional($about)->field['content'] ?? ''; ?></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>