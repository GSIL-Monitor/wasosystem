
    <div class="hotServer P_hide"<?php if($recommends->isEmpty()): ?> style="display: none" <?php endif; ?>>
        <div class="wrap">
            <h6 class="tit">相关推荐</h6>
            <ul>
                <?php $__currentLoopData = $recommends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $recommendPic=order_complete_machine_pic($recommend->complete_machine_product_goods) ?? [];?>
                    <li class="<?php if($loop->index ==2): ?> last <?php endif; ?>">
                        <a href="<?php echo e(route('server.show',$recommend->id)); ?>">
                            <img class="lazy" data-original="<?php echo e($recommendPic); ?>">
                            <h5>网烁<?php echo e($recommend->name); ?></h5><span>立即查看</span>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>
        </div>
    </div>