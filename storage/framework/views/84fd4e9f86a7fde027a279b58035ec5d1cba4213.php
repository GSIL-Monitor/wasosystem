<?php $__currentLoopData = $order->order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="orderList orderList1 MainOrder">
        <div class="imgs"><img src="<?php echo e(asset('pic/product/'.$product_good->product->bianhao.'.png')); ?>"></div>
        <div class="links_a"><?php echo e($product_good->jiancheng); ?></div>
        <div class="price"  style="display: none"><span class="pri" data-id="<?php echo e($product_good->pivot->product_good_price); ?>"><?php echo e($product_good->pivot->product_good_price); ?></span>.00元
        </div>
        <div class="num">
            <div class="num_box">
                <button class="delNum <?php if($product_good->pivot->product_good_num == 1): ?> none <?php endif; ?>">-</button>
                <input type="text" class="PJnum good_num OneNumber" name="good_list[<?php echo e($product_good->id); ?>]"
                       value="<?php echo e($product_good->pivot->product_good_num); ?>">
                <button class="addNum">+</button>
                <div class="clear"></div>
            </div>
        </div>
        <div class="total pri" style="display: none" ><span class="to"><?php echo e($product_good->pivot->product_good_num); ?></span>
        </div>
        <div class="control" >
          <span><a class="Del" data_condition="<?php echo e($order->id); ?>" data_id="<?php echo e($product_good->id); ?>" data_url="<?php echo e(url('/orders/destory')); ?>"
                   data_title="<?php echo e($product_good->jiancheng); ?>">删除</a></span>
        </div>
        <div class="clear"></div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" name="num" value="<?php echo e($order->num); ?>">