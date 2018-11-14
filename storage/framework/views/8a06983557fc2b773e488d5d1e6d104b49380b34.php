<table class="listTable">
    <tr>
        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
        <th  class="">订单序列号</th>
        <th class="">订单状态</th>
        <th class="">订单未付价格</th>
        <th class="">付款情况</th>
        <th class="">款项状态</th>
        <th class="">提交时间</th>
        <th class="">操作</th>
    </tr>
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="tableInfoDel">
                <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($order->id); ?>">
            </td>
            <td class="tableInfoDel  tablePhoneShow  tableName">
                <?php echo e($order->serial_number); ?>

            </td>
            <td class=""><?php echo e($parameters['order_status'][$order->order_status]); ?></td>
            <td class=""><?php echo e($order->total_prices); ?></td>
            <td class="payments">
                <?php
                $price=$funds_management->where([
                ['comment','like',"%$order->serial_number%"],
                ['type','=','down_payment'],
                ])->sum('price');
                ?>
               已支付 <span> <?php echo e($price); ?></span>
               未支付 <span class="payment"> <?php echo e($order->total_prices - $price); ?></span>
            </td>
            <td class=""><?php echo e($parameters['payment_status'][$order->payment_status]); ?></td>
            <td class=""><?php echo e($order->created_at); ?></td>
            <td class="pays"><a class="pay" data-type="down_payment" serial_number="<?php echo e($order->serial_number); ?>" price="<?php echo e($order->total_prices - $price); ?>" >支付定金</a></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td><div class='error'>没有数据</div></td></tr>
    <?php endif; ?>
</table>