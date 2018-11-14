<div class="orderList MainOrder">
    <div class="imgs openImg">
        <ul class="scroll_pic">
            <li><span><img src="<?php echo e(order_complete_machine_pic($order->order_product_goods)); ?>"></span></li>
        </ul>
    </div>
    <div class="links_a openDetail"><?php echo e($order->machine_model); ?></div>
    <div class="price"><span class="pri danjia" data-id="<?php echo e($order->unit_price); ?>"><?php echo e($order->unit_price); ?></span>.00元</div>
    <div class="num">
        <div class="num_box">
                <button class="delNum <?php if($order->num == 1): ?> none <?php endif; ?>">-</button>
                <input type="text" class="good_num " name="num" value="<?php echo e($order->num); ?>"
                       autocomplete="off">
                <button class="addNum"  >+</button>
            <div class="clear"></div>
        </div>
    </div>
    <div class="total pri"><span class="to total_to"></span>.00元</div>
    <?php if($order->order_status =='intention_to_order'): ?>
    <div class="control"><span><a class="editDetail" href="javascript:;">修改配置</a></span>
    <?php endif; ?>
    </div>
    <span class="clear"></span>
</div>

<div class="detailTable">
    <ul>
        <?php $__currentLoopData = $order_details['complete_machine_detailed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><span class="DTit"><?php echo e($key); ?></span><span><?php echo e($detail); ?></span>
            <div class="clear"></div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li><span class="DTit">温馨提示</span><span><span style="color: red">*以上内容仅供参考，不构成任何约束和承诺，详情及价格请联系客服！</span></span><div class="clear"></div></li>
    </ul>

    <div class="download">
        <a href="<?php echo e(route('orders.show',$order->id)); ?>?export=UnitQuotation&export_name=整机报价表">【下载 服务器明细及报价表】</a>
        <?php if(user()->parts_buy): ?>
        <a href="<?php echo e(route('orders.show',$order->id)); ?>?export=AccessoriesOffer&export_name=配件报价表">【下载 服务器配件报价表】</a>
        <?php endif; ?>
        <p>* 报价表请在电脑端下载</p>
    </div>
</div>

   <span class="proDetail">展开配置<i></i></span>
    <?php $__currentLoopData = $order->order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="complete_machine_parts" style="display: none">
            <div class="price TD"><span class="pri"
                                        data-id="<?php echo e($product_good->pivot->product_good_price); ?>"><?php echo e($product_good->pivot->product_good_price); ?></span>.00元
            </div>
            <div class="num TD">
                <div class="num_box">
                    <input type="text" class="PJnum good_num OneNumber"
                           value="<?php echo e($product_good->pivot->product_good_num); ?>">
                    <div class="clear"></div>
                </div>
            </div>
            <div class="total TD"><span class="to"></span>.00元</div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

