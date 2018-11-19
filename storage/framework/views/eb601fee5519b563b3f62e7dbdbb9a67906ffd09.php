<dl>
    <dt>分类：</dt>
    <dd><a href="<?php echo e(route('server.index','graphic_workstation_designer_computer')); ?>" class="<?php if(!$complete_machine_framework && $id != 'storage'): ?> a2 <?php endif; ?>">全部</a></dd>
    <?php $__currentLoopData = $graphic_workstation_designer_computer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key !='0' && $key !=''): ?>
            <dd><a class="<?php if($complete_machine_framework && $complete_machine_framework->name == $key): ?> a2 <?php endif; ?>" href="<?php echo e(route('server.index',$complete_machine_category[$key])); ?>"><?php echo e($key); ?></a></dd>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="clear"></div>
</dl>