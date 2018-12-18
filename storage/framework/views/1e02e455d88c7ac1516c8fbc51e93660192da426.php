
<?php $__env->startSection('title',$integration->name); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/solution_info.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div class="solPic">
            <div class="wrap"><h5><?php echo e($integration->parent->name); ?>解决方案</h5></div>
        </div>
        <div class="sol_box">
            <div class="wrap">
                <div class="typeLinks">
                    <ul>
                        <h5><?php echo e($integration->parent->name); ?> 解决方案</h5>
                        <?php $__currentLoopData = $integration->parent->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="<?php if($integration->id == $child->id): ?> active <?php endif; ?>"><a href="<?php echo e(route('solution.show',$child->id)); ?>"><?php echo e($child->name); ?></a></li>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="news_info">
                    <h5 class="news_tit"><b><?php echo e($integration->name); ?></b></h5>
                    <div class="infoTxt">
                        <?php echo str_replace('src="https','class="lazy" data-original="https',$integration->details); ?></div>
                    <div class="go_back"><a href="<?php echo e(route('solution')); ?>">返回上页</a></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>

        <?php if($integration->Integration_complete_machines->isNotEmpty()): ?>
            <div class="hotSolutions">
                <div class="wrap">
                    <h5 class="tit">产品解决方案</h5>
                    <ul class="proSolution">
                            <?php $__currentLoopData = $integration->Integration_complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php if($complete_machine->parent_id ==1 ): ?><?php echo e(route('server.show',$complete_machine->id)); ?><?php else: ?><?php echo e(route('server.designer',$complete_machine->id)); ?><?php endif; ?>" >
                                    <img src="<?php echo e(order_complete_machine_pic($complete_machine->complete_machine_product_goods) ?? ''); ?>"/>
                                    <h3><?php echo e($complete_machine->name); ?></h3><p><?php echo e($complete_machine->additional_arguments['product_description']); ?></p><h6>查看更多</h6>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>