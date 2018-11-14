<div class="buy_left">
    <div class="main_pic" title="点击查看大图">
        <?php $pics=order_complete_machine_pic($completeMachine->complete_machine_product_goods,'all') ?? [];?>
        <?php switch($completeMachine->marketing):
            case ('new'): ?>
            <i class="saleIcon newP"></i>
            <?php break; ?>;
            <?php case ('hot'): ?>
            <i class="saleIcon hotP"></i>
            <?php break; ?>;
            <?php case ('moods'): ?>
            <i class="saleIcon popP"></i>
            <?php break; ?>;
            <?php case ('sale'): ?>
            <i class="saleIcon saleP"></i>
            <?php break; ?>;
        <?php endswitch; ?>
        <span data-close="" class="close" title="关闭">×</span>
        <span class="arrow leftArrow">‹</span>
        <span class="arrow rightArrow">›</span>
        <ul class="bigP">
          <?php $__empty_1 = true; $__currentLoopData = $pics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="<?php if($loop->index == 0): ?>active <?php endif; ?>"
                    data-number="<?php echo e($loop->index); ?>">
                    <img class="lazy"
                         data-original="<?php echo e($item['url']); ?>"
                         data-src="<?php echo e($item['url']); ?>">
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <?php endif; ?>
            <div class="clear"></div>
        </ul>
    </div>

    <div class="picsBox">
        <ul class="scroll_pic">
            <?php $__empty_1 = true; $__currentLoopData = $pics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="<?php if($loop->index == 0): ?>active <?php endif; ?>" data-number="<?php echo e($loop->index); ?>"><img src="<?php echo e($item['url']); ?>"></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
            <div class="clear"></div>
        </ul>
    </div>

    <div class="clear"></div>
</div>