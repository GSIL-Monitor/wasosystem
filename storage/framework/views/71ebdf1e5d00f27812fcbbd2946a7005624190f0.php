<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title><?php echo $__env->yieldContent('title','个人中心'); ?>-网烁信息科技有限公司</title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords','keywords'); ?>"/>
    <meta name="description" content="<?php echo $__env->yieldContent('description','description'); ?>"/>
    <?php echo $__env->yieldContent('meta'); ?>
    
    <?php echo $__env->make('site.layouts.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>

<?php echo $__env->make('member_centers.orders.layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('member_centers.orders.layouts.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
