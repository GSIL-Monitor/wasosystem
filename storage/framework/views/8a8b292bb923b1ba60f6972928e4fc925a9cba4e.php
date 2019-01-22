<div class="indexPro">
    <div class="wrap">
        <div class="indexTit">推荐</div>
        <ul>
            <?php $__currentLoopData = $complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $pics=order_complete_machine_pic($complete_machine->complete_machine_product_goods,'all');?>
                <li>
                    <a href="<?php if($complete_machine->parent_id ==1 ): ?>
                    <?php echo e(route('server.show',$complete_machine->id)); ?>

                    <?php else: ?>
                    <?php echo e(route('server.designer',$complete_machine->id)); ?>

                    <?php endif; ?>">
                        <?php switch($complete_machine->marketing):
                            case ('new'): ?>
                            <i class="saleIcon newP">新品</i>
                            <?php break; ?>;
                            <?php case ('hot'): ?>
                            <i class="saleIcon hotP">热卖</i>
                            <?php break; ?>;
                            <?php case ('moods'): ?>
                            <i class="saleIcon popP">人气</i>
                            <?php break; ?>;
                            <?php case ('sale'): ?>
                            <i class="saleIcon saleP">折扣</i>
                            <?php break; ?>;
                        <?php endswitch; ?>
                        <div class="proPic">

                            <img data-original="<?php echo e($pics[0]['url'] ?? ''); ?>" class="topPic lazy">
                            <img data-original="<?php echo e($pics[1]['url'] ?? ''); ?>" class="botPic lazy">
                        </div>
                        <div class="name">
                            <h5>网烁<?php echo e(explode('-',$complete_machine->name)[0]); ?></h5>
                            <p><?php echo e($complete_machine->additional_arguments['product_description']); ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="clear"></div>
        </ul>
    </div>
</div>