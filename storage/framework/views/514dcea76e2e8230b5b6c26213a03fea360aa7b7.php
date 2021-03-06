<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>网烁信息综合管理系统</title>
    
    
    
    <link rel="stylesheet" href="<?php echo e(asset('admin/common/backend_index.css')); ?>" type="text/css">
    
    
    
    <?php echo $__env->make('admin.index.IE', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body id="SysBody">
<div id="bigBlack"></div>
<div id="content" style="width: 100%; max-width: 100%">
    <div id="C_left">
        <div class="C_leftContainer">
            <?php echo $__env->make('admin.index.myinfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
            <?php echo $__env->make('admin.index.i_leftsider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
        </div>
        <div id="LeftBtn" class="LeftShou"></div>
    </div>

    <div id="C_right">

        <?php echo $__env->make('admin.index.i_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
        <?php echo $__env->make('admin.index.i_body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
        <?php echo $__env->make('admin.index.i_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
    </div>
    <div class="clear"></div>
</div>

<script src="<?php echo e(asset('admin/common/backend_index.js')); ?>" type="text/javascript"></script>
</body>
</html>
