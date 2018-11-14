<div class="fixLinks">
    <div class="wrap">
        <div class="fixBtn">
            <button class="buy_now P_hide shop_car_btn buy">意向保存</button>
            <button class="buy_now P_hide editDetail hop_car_btn editDetail">基础配置修改</button>
            <div class="clear"></div>
        </div>

        <div class="price P_hide">
            <?php $pic=order_complete_machine_pic($completeMachine->complete_machine_product_goods)  ?? null;?>
            <img src="<?php echo e($pic ?? ''); ?>">
            <span>
                        <h5 class="names">网烁<?php echo e(str_before($completeMachine->name,'-')); ?>基础配置</h5>
                <?php if(auth()->guard('user')->check()): ?>
                    <h5><?php echo e($completeMachine->UnitPrice()); ?>.00元</h5>
                    <?php else: ?>
                        <a name="F_news" class="F_news talkBtn"
                           data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125">咨询在线客服</a>
                        <?php endif; ?>
                      </span>
            <div class="clear"></div>
        </div>

        <ul>
            <li class="active"><a name="serverInduce" id="page1">商品介绍</a></li>
            <li><a name="detail" id="page2">规格参数</a></li>
            <li class="P_hide" <?php if($completeMachine->information_management_complete_machines->isEmpty()): ?> style="display: none" <?php endif; ?>><a name="otherServer" id="page3">相关资讯</a></li>
            <li class="P_hide" <?php if(drive($completeMachine->complete_machine_product_goods)->isEmpty()): ?> style="display: none" <?php endif; ?>><a name="serverDown" id="page4">驱动下载</a></li>
            <?php if(auth()->guard('user')->check()): ?>
            <li class="last" <?php if($sales_records->isEmpty()): ?>style="display: none" <?php endif; ?>><a name="sale_records" id="page5">销售记录（<?php echo e($sales_srecord_count); ?>）</a></li>
            <?php endif; ?>
                <div class="clear"></div>
        </ul>
    </div>
</div>