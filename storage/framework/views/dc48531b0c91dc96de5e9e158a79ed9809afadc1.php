<div class="other">
    <h5 class="orderTit">服务模式 <a href="<?php echo e(route('service_support.service_clause',41)); ?>" target="_blank">服务说明</a></h5>
    <div class="p_serverBox phoneOrderInfo">
        <div class="tit">服务模式</div>
        <div class="content">原厂邮寄送修服务(免费)</div>
        <i class="arrow"></i>
        <div class="clear"></div>
    </div>
    <div class="serverBox">
        <?php $__currentLoopData = $service_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="chosL <?php if($status->identifying  == $order->service_status): ?> activeLabel <?php endif; ?>">
            <i class="chooseIcon"></i>
            <input type="radio" autocomplete="off"   <?php if($status->identifying  == $order->service_status): ?>) checked  <?php endif; ?>  class="service_status" name="service_status" value="<?php echo e($status->identifying); ?>">
            <?php echo e($status->name); ?>

          </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="clear"></div>
    </div>
</div>