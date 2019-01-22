<div class="nowSit">
    <h5>已为您匹配<?php echo e($server_selections->count()); ?>款配置<span class="goBtn"><b class="gotoBack">上一步</b></span></h5>
</div>
    <ul>
     <?php $__currentLoopData = $server_selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php if(str_contains($loop->index,[3,7,11,15])): ?> last <?php endif; ?>">
                <a href="<?php if(optional($selection->good)->parent_id ==1 || optional($selection)->parent_id ==1): ?>
                <?php echo e(route('server.show',$selection->good->id ?? $selection->id)); ?>

                <?php else: ?>
                <?php echo e(route('server.designer',$selection->good->id ?? $selection->id)); ?>

                <?php endif; ?>" target="_blank">
                    <img src="<?php echo e(order_complete_machine_pic($selection->good->complete_machine_product_goods ?? $selection->complete_machine_product_goods) ?? ''); ?>">
                    <h5><?php echo e($selection->name); ?> <?php echo e($selection->parent_id); ?></h5>
                </a>
                <a class="savePro" href="<?php if(optional($selection->good)->parent_id ==1 || optional($selection)->parent_id ==1): ?>
                <?php echo e(route('server.show',$selection->good->id ?? $selection->id)); ?>

                <?php else: ?>
                <?php echo e(route('server.designer',$selection->good->id ?? $selection->id)); ?>

                <?php endif; ?>">查看详情</a>
                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="clear"></div>
    </ul>


