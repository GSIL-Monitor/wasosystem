<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title><?php echo $__env->yieldContent('title','首页'); ?>-网烁信息科技有限公司</title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords','keywords'); ?>"/>
    <meta name="description" content="<?php echo $__env->yieldContent('description','description'); ?>"/>
    <?php echo $__env->yieldContent('meta'); ?>
    
    <?php echo $__env->make('site.layouts.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body <?php if(auth()->guard('user')->guest()): ?>onselectstart="return false" CloseOpen onbeforeunload="shijian()" <?php endif; ?>>

<?php echo $__env->make('site.layouts.head',['common_complete_machines'=>$common_complete_machines], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="body" id="app" >
        <div class="wrap">
            <i class="PhoneSearch"></i>
        </div>

        <div id="crumbs">
            <div class="wrap"><a href="/">首页</a> > <a href="<?php echo e(route('member_center')); ?>">个人中心</a> > <?php echo $__env->yieldContent('title',''); ?></div>
        </div>

        <div class="wrap">
            <div class="info_box">
                <div class="left">
                    <?php echo $__env->make('member_centers.person_links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

                <?php echo $__env->yieldContent('content'); ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php echo $__env->make('site.layouts.foot',['common_solutions'=>$common_solutions], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
