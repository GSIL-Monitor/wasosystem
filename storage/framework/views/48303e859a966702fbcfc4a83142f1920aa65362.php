<form action="<?php echo e($url); ?>" method="get">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="search">
        <?php if(isset($condition) && !empty($condition)): ?>
        <?php echo e(Form::select('type',$condition,old('type',Request::input('type')),$select_data ?? [])); ?>

        <?php endif; ?>
        <?php if(!isset($show_input) || $show_input == true): ?>
        <?php echo e(Form::text('keyword',old('keyword',Request::input('keyword')),['placeholder'=>$placeholder ?? '请输入关键字'])); ?>

        <?php endif; ?>
        <?php if(isset($status)): ?>
        <?php $__empty_1 = true; $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>" placeholder="">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>
        <?php endif; ?>
            <?php echo $select ?? ''; ?>

        <input type="submit" class="Btn green"  value="<?php echo e($btn ?? '搜索'); ?>">
    </div>
</form>