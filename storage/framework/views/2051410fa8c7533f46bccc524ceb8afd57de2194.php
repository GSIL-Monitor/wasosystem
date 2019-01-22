<div class="serverDown P_hide" name="serverDown" <?php if(drive($completeMachine->complete_machine_product_goods)->isEmpty()): ?> style="display: none" <?php endif; ?>>
    <div class="wrap">
        <h6 class="tit">驱动下载</h6>
        <ul class="down">
            <?php if(auth()->guard('user')->check()): ?>
                    <?php $__empty_1 = true; $__currentLoopData = drive($completeMachine->complete_machine_product_goods); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <a href="<?php echo e(url('/downloadFile')); ?>?file=<?php echo e($item->file['url']); ?>&name=<?php echo e($item->file['name']); ?>" >
                           <?php echo e($item->file['name']); ?><i></i>
                        </a>
                    </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
               <?php else: ?>
                <div class="error" style="text-align: center">
                    请 <a href="<?php echo e(route('login')); ?>" style="color: #0187CE">登录</a> 后下载！
                </div>
            <?php endif; ?>
            <div class="clear"></div>
        </ul>
    </div>
</div>