<div class="right">
    <div class="info">
        <div class="tit bigTit">
            <h5>我的收藏</h5>
            <p>收藏您关注的产品，方便您第一时间了解最新信息</p>
        </div>

        <div class="mycollection">
            <ul>
                <?php $__empty_1 = true; $__currentLoopData = $collects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <a name="F_news" href="<?php echo e(route('server.show',$collect->id)); ?>" target="_blank"  title="<?php echo e($collect->name); ?>" target="_blank">
                            <img src="<?php echo e(order_complete_machine_pic($collect->complete_machine_product_goods)); ?>" />
                            <div class="pro_info">
                                <p><?php echo e($collect->name); ?></p>
                            </div>
                        </a>
                        <div class="control">
                            <i class="delcoll" data_url="<?php echo e(route('server.collectRemove',$collect->id)); ?>">取消收藏</i>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty">您暂时没有收藏的产品</div>
                <?php endif; ?>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <?php echo $collects->links(); ?>

</div>