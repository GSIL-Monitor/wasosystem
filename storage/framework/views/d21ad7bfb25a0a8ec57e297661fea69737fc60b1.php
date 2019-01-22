<?php echo $__env->make('member_centers.orders.components.lookPic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="pro_detail" id="app">
    <?php if($order->order_type !='parts'): ?>
             <?php echo $__env->make('member_centers.orders.components.material_editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php endif; ?>
</div>
<!--   编辑配置  END  -->
<!--<button class="editShop">编辑</button>-->
<div class="order_xiadan">
        <?php echo Form::open(['onsubmit'=>'return false','method'=>'put','class'=>'order_edit']); ?>

        <div class="body orderBody">
            <div class="wrap">
                <div id="crumbs">
                    <a href="/">首页</a> > <a href="javascript:history.back()" target="_blank;"> 我的订单 </a>
                    > <?php echo e($order->serial_number); ?>

                </div>
                <div class="want_confirm">
                    <?php echo $__env->make('member_centers.orders.components.logistics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('member_centers.orders.components.product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('member_centers.orders.components.service', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('member_centers.orders.components.company', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="otherInfo">
                        <h5 class="orderTit">备注信息</h5>
                        <textarea name="user_remark"
                                  placeholder="如有其他需求请备注，字数请限制在300字以内，如有特殊要求，请与在线客服取得联系。"><?php echo e(optional($order)->user_remark ?? ''); ?></textarea>
                    </div>
                    <?php echo $__env->make('member_centers.orders.components.confirmInfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

        </div>
</div>
<?php echo Form::close(); ?>

</div>
