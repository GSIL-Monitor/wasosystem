<div class="address">
    <div class="Border borderTop"></div>
    <h5 class="orderTit">收货地址 <a href="<?php echo e(route('user_addresses.index')); ?>" target="_blank">新增 / 修改地址</a></h5>
    <!--  选中的地址  START   -->
    <div class="CheckAddr"></div>
    <div class="addrMore">
        <div class="addrBox">
            <ul class="chooseBox">
                <input type="hidden" name="logistics_id" class="logistics_id">
                <?php $__currentLoopData = $order->user->user_address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php if($order->logistics_id == $address->id): ?>
                                active
                                <?php else: ?>
                                <?php if($address->default && !$order->logistics_id): ?>
                                        active
                               <?php endif; ?> <?php endif; ?>
                                logistics"
                                data-id="<?php echo e($address->id); ?>"
                    >
                        <div class="addrInfo" >
                            <i></i>
                            <span class="names"><em><?php echo e($address->number); ?>:</em><?php echo e($address->name); ?></span>
                            <span class="tell"><?php echo e($address->phone); ?></span>
                            <span class="addr"><?php echo e($address->address); ?></span>
                            <span class="zhiD"><?php echo e($address->logistics); ?></span>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="addBtns">
        <a class="MoreBtn" target="_blank"><i></i></a>
    </div>
</div>