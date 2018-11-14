<div class="order_xiadan">
    <div class="body orderBody">
        <div class="wrap infowrap">
            <div id="crumbs">
                <a href="/">首页</a> > <a href="<?php echo e(route('orders.index')); ?>?order_status=<?php echo e($order->order_status); ?>" target="_blank;"> 我的订单 </a> > <?php echo e($order->serial_number); ?>

            </div>

            <div class="NowSituation">
                <input type="hidden" value="<?php echo e($parameters['order_status_code'][$order->order_status]); ?>" class="Svalue">
                <!--   流程图  -->
                <div class="p_icon">
                    <ul class="icons">
                        <li class="active"><i></i><span>意向订单</span></li>
                        <li><i></i><span>下单订货</span></li>
                        <li><i></i><span>订单受理</span></li>
                        <li><i></i><span>在途运输</span></li>
                        <li><i></i><span>成交订单</span></li>
                        <div class="clear"></div>
                    </ul>
                    <div class="p_liucheng_bg"></div>
                    <div class="p_liucheng_line"></div>

                    <ul class="iconDetail">
                        <li class="active"><p><i></i>待客户确认商品信息并确认下单</p></li>
                        <li><p><i></i>订单已提交，商务人员正在进行配货</p></li>
                        <li><p><i></i>商品已完成配货打包，等待发货</p></li>
                        <li><p><i></i>商品已发货，请注意收货物流货运送货通知</p></li>
                        <li><p><i class="done"></i>订单完成，感谢您的购买，期待您的再次光临</p></li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <!--    流程图完  -->
            </div>

            <?php echo $__env->make('member_centers.orders.components.product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            <div class="order_info">
                <h5 class="orderTit">订单信息</h5>
                <ul class="infoTable">
                    <li><span class="infoTit">创建时间：</span><span><?php echo e($order->created_at); ?></span><div class="clear"></div></li>
                    <li><span class="infoTit">服务模式：</span><?php echo e($parameters['service'][$order->service_status]); ?><div class="clear"></div></li>
                   <?php if($order->market): ?>
                        <li><span class="infoTit">指定客服：</span><span>
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo e($order->markets->qq); ?>&amp;site=qq&amp;menu=yes">
                                        <img title="与我交流" border="0" src="http://wpa.qq.com/pa?p=2:<?php echo e($order->markets->qq); ?>:52 &amp;r=0.20370674575679004">
                                </a>
                                 <em class="P_hide"><i></i><?php echo e($order->markets->phone); ?></em>
                                <div class="PC_hide"><a href="tel:<?php echo e($order->markets->phone); ?>">点击通话</a></div>
                                </span>
                        </li>
                    <?php endif; ?>
                    <div class="clear"></div>
                </ul>
            </div>


                <div class="order_info">
                    <h5 class="orderTit">票据信息</h5>
                    <ul class="infoTable">
                        <?php if($order->invoice_type != 'no_invoice'): ?><li><span class="infoTit">开票单位：</span><span><?php echo e($order->company->name); ?></span><div class="clear"></div></li>  <?php endif; ?>
                        <li><span class="infoTit">含税模式：</span><span>   <?php if($order->invoice_type != 'no_invoice'): ?> 单位采购 <?php else: ?> 个人采购 <?php endif; ?> </span><div class="clear"></div></li>
                        <div class="clear"></div>
                    </ul>
                </div>

            <!-- 付款后显示 税票 -->

                   <?php if(str_contains($order->order_status,['in_transportation','arrival _of_goods'])): ?>
                    <div class="order_info">
                        <h5 class="orderTit">物流信息</h5>
                        <ul class="infoTable">
                                <?php if($order->logistics_info): ?><li><span class="infoTit">物流信息：</span><span><?php echo e($order->logistics_info); ?></span><div class="clear"></div></li><?php endif; ?>
                                <li><span class="infoTit">商品件数：</span><span> <?php echo e($order->parcel_count); ?> 件</span><div class="clear"></div></li>
                                <div class="clear"></div>
                               <?php if($order->address): ?>
                                <div class="infoDetail">
                                    <li><span class="infoTit">收&nbsp;&nbsp;货&nbsp;&nbsp;人：</span><span><?php echo e($order->address->name); ?></span><div class="clear"></div></li>
                                    <li><span class="infoTit">联系电话：</span><span><?php echo e($order->address->phone); ?></span><div class="clear"></div></li>
                                    <li><span class="infoTit">收货地址：</span><span><?php echo e($order->address->address); ?></span><div class="clear"></div></li>
                                    <li class="P_hide"><span class="infoTit">&nbsp;</span><span>&nbsp;</span><div class="clear"></div></li>
                                    <div class="OpenDetail"><span>更多信息</span></div>
                                </div>
                                <?php endif; ?>
                                    <?php if($order->user_remark): ?>
                                     <li><span class="infoTit">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</span><span><?php echo e($order->user_remark); ?></span><div class="clear"></div></li>
                                    <?php endif; ?>
                            <div class="clear"></div>
                        </ul>

                        <?php if($order->company_remark): ?>
                            <h5 class="orderTit">订单要求 </h5>
                            <ul class="infoTable">
                                <li><span class="infoTit">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</span><span><?php echo e($order->company_remark); ?></span><div class="clear"></div></li>
                                <div class="clear"></div>
                            </ul>
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
            <!-- 付款后显示 物流信息-->

            <div class="otherInfo">
                <h5 class="orderTit">备注信息</h5>
                <textarea name="user_remark" placeholder="字数请限制在300字以内，如有特殊要求，请与在线客服取得联系。" disabled><?php echo e($order->company_remark); ?></textarea>
            </div>

           <?php if($order->flow_pic): ?>
                <div class="liuPic">
                    <h5 class="orderTit">装机流程图</h5>
                    <div class="picsBox">
                        <div class="buy_left">
                            <div class="main_pic" title="点击查看大图">
                                <span data-close="" class="close" title="关闭">×</span>
                                <span class="arrow leftArrow">‹</span>
                                <span class="arrow rightArrow">›</span>
                                <?php   $flow_chart=json_decode($order->pic,true);?>
                                <ul>
                                        <?php $__empty_1 = true; $__currentLoopData = $flow_chart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li data-number="<?php echo e($loop->index); ?>" class="<?php if($loop->index ==0 ): ?> active <?php endif; ?>"><img class="lazy" data-original="<?php echo e($item['url']); ?>" src="<?php echo e($item['url']); ?>"></li>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li> 没有流程图</li>
                                        <?php endif; ?>

                                    <div class="clear"></div>
                                </ul>
                            </div>

                            <div class="picsBox">
                                <ul class="scroll_pic">
                                    <?php $__empty_1 = true; $__currentLoopData = $flow_chart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li data-number="<?php echo e($loop->index); ?>" class="<?php if($loop->index ==0 ): ?> active <?php endif; ?>"><img class="lazy" data-original="<?php echo e($item['url']); ?>" src="<?php echo e($item['url']); ?>"></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li> 没有流程图</li>
                                    <?php endif; ?>
                                    <div class="clear"></div>
                                </ul>
                            </div>

                            <div class="clear"></div>
                        </div>
                        <div class="phone_lookMoreBg"></div>
                        <div class="phone_lookMore">查看全部</div>
                    </div>
                </div>
          <?php endif; ?>

            <div class="confirmInfo">
                <div class="erweiBox">
                    <h5>配置代码</h5>
                    <input type="text" value="<?php echo e($order->code); ?>" class="codes" disabled>
                    <button class="copyInfoBtn" data-clipboard-text="<?php echo e($order->code); ?>">复制代码</button>
                    <a href="javascript:;" class="PC_hide">查看配置二维码</a>
                    <div id="peizhi"></div>
                </div>
                <div class="tableTotal total">
                    <div class="editOpen"></div>
                    <div class="orderPrice">
                        <ul>
                            <li><span class="bottomTit">单套价格：</span><span class="bottomContent"><?php echo e($order->unit_price); ?>.00元</span><div class="clear"></div></li>
                            <?php if($order->service_status > 0): ?>
                                <li><span class="bottomTit">服务费：</span><span class="bottomContent"><?php echo e($order->service_status); ?>.00元</span><div class="clear"></div></li>
                            <?php endif; ?>
                            <li><span class="bottomTit">总金额：</span><span class="bottomContent"><b><?php echo e($order->total_prices); ?>.00元</b></span><div class="clear"></div></li>
                            <li><span class="bottomTit">款项状态：</span>
                                <span class="bottomContent">
                                    <?php if($order->payment_status == 'account_paid'): ?>
                                        已付货款
                                    <?php else: ?>
                                        未付货款
                                    <?php endif; ?>
                                </span>
                                <div class="clear"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="confirm_btns">
                <div class="confirm_btn">
                    <a class="P_hide goBack" href="<?php echo e(route('orders.index')); ?>?order_status=<?php echo e($order->order_status); ?>">返回</a>
                    <?php if($order->order_status == 'placing_orders'): ?>

                        <a class="phoneAllBtn  order_save" data-status="intention_to_order"   data-url="<?php echo e(route('orders.update',$order->id)); ?>">取消下单</a>
                   <?php endif; ?>
                    <?php echo Form::open(['onsubmit'=>'return false','method'=>'put','class'=>'order_edit']); ?>

                    <input type="hidden" value="cancel_the_order" name="status">
                    <?php echo Form::close(); ?>

                </div>
            </div>

        </div>
    </div>
</div>
