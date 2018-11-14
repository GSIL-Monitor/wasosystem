<div class="other">
    <h5 class="orderTit">票据信息<a href="<?php echo e(route('user_companies.index')); ?>" target="_blank">新增 / 修改信息</a></h5>
    <div class="p_piaoBox phoneOrderInfo">
        <div class="tit">票据信息</div>
        <div class="content"></div>
        <i class="arrow"></i>
        <div class="clear"></div>
    </div>


    <div class="other_box">
        <div class="tip"><i></i>选择【单位采购】，单价将变成含税价格 </div>
        <?php $__currentLoopData = config('site.member_center_order_invoice'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $invoice_type_active = '';
                 $invoice_type_checked=''
            ?>
            <?php if($key == $order->invoice_type ): ?>
                <?php $invoice_type_active = 'activeLabel';
                     $invoice_type_checked='checked'
                ?>
            <?php endif; ?>
                <label class="chosL <?php echo e($invoice_type_active); ?>" ><input type="radio" name="invoice_type" value="<?php echo e($key); ?>" <?php echo e($invoice_type_checked); ?> class="invoice">  <?php echo e($item); ?><em></em></label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="clear"></div>
        <div class="hide_box">
            <!--  选中的地址  START   -->
            <input type="hidden" name="invoice_info" class="invoice_info">
            <div class="ticksAddr"></div>
            <div class="addrMore">
                <div class="ticksBox">
                    <ul class="chooseBox">
                        <?php $__currentLoopData = $order->user->user_company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="<?php if($order->invoice_info == $item->id): ?>
                                    active
                                    <?php else: ?>
                                    <?php if($item->default && !$order->invoice_info): ?>
                                    active
                                    <?php endif; ?> <?php endif; ?> company"
                                    data-id="<?php echo e($item->id); ?>">
                                <div class="addrInfo ">
                                    <i></i>
                                    <span class="names"><?php echo e($item->name); ?></span>
                                    <span class="addr"><?php echo e($item->invoice_type); ?></span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="clear"></div>
                    </ul>
                </div>
                <!-- 选择开票地址  END  -->
            </div>
            <div class="ticksBtns">
                <a class="MoreTicksBtn" target="_blank">更多单位<i></i></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>