<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title><?php echo $__env->yieldContent('title','账号审核中'); ?>-网烁信息科技有限公司</title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords','keywords'); ?>"/>
    <meta name="description" content="<?php echo $__env->yieldContent('description','description'); ?>"/>
    <link href="<?php echo e(asset('css/public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/register.css')); ?>" rel="stylesheet" type="text/css">
</head>
<body>

<div id="login_wait">
    <div class="wrap">
        <div class="logo_bg">
            <a class="logo" href="/"><img src="<?php echo e(asset('pic/logo.png')); ?>"></a>
        </div>

        <div class="title"><h5><?php echo e($user); ?><br/>账号审核中</h5></div>

        <div class="thanks">
            <h6>请尽快联系<a name="F_news" class="talkBtn" data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&amp;userId=2178125">在线客服</a>，加快账户认证。再次感谢您对网烁的支持与厚爱，客服热线：400-028-1968</h6>
            <a class="goBackIndex" href="/">返回首页</a>
        </div>

    </div>
</div>

<div id="register_foot">
    <div class="wrap">
        <h5>Copyright © <span class="year"></span> 成都网烁信息科技有限公司 版权所有<br> ICP备案编号：蜀 ICP(备)10025767号</h5>
    </div>
</div>
</body>
<?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>
