<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <?php echo $__env->yieldContent('meta'); ?>
    
    <?php echo $__env->make('admin.layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
<audio id="wavFileId" src="<?php echo e(asset('mp3/xiadan.wav')); ?>" style="display: none;" ></audio>
    
    <?php echo $__env->yieldContent('content'); ?>
    
   
    <?php echo $__env->yieldContent('js'); ?>
    <script>
        $(function() {
            <?php $__currentLoopData = ['error','success','info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(session()->has($msg)): ?>
                toastrMessage("<?php echo e($msg); ?>","<?php echo e(session()->get($msg)); ?>");
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            if($('.new').length > 0){
                $("#wavFileId").attr("autoplay","autoplay");
            }
        });
        </script>
</body>
</html>
