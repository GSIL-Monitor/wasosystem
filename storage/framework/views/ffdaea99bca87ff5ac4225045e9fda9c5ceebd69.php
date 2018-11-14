<div class="pro_list">
    <h5 class="orderTit">商品信息<span>订单编号：<?php echo e($order->serial_number); ?></span></h5>
    <div class="orderTable">
        <div class="ComfirInfo">
                <div class="menu">
                    <div class="imgs" style="text-align:left;">商品</div>
                    <div class="links_a"></div>
                    <?php if($order->order_type !='parts'): ?>
                    <div class="price">单价</div>
                    <?php endif; ?>
                    <div class="num"> 数量</div>
                    <?php if($order->order_type !='parts'): ?>
                    <div class="total"> 小计</div>
                    <?php endif; ?>
                    <div class="control"> 操作</div>
                </div>
        <?php if($order->order_type !='parts'): ?>
                <?php echo $__env->make('member_centers.orders.components.complete_machine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('member_centers.orders.components.parts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        </div>

        <div class="orderTotal">合计：<span><b class="AllPri"></b>.00元</span></div>
    </div>
    <!--购物车订单 结束-->
</div>