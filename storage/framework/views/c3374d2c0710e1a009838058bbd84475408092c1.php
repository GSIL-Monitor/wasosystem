
<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>资金管理</h5>
                        <p>您可以在这里查看金额使用情况。</p>
                    </div>

                    <div class="TotalPrice">
                        <div class="PriceTable">
                            <?php if(count($orders) > 0): ?>
                                未付货款<i>：</i><span class="HaveDept"><b id="price"><?php echo e($orders->sum('total_prices')); ?></b>.00元</span>
                                <?php else: ?>
                                <span class="NotDept">太棒了，没有欠款！</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="moneyBox">
                        <ul class="PageSelect">
                            <li class="<?php if(!Request::has('p')): ?> active <?php endif; ?>"><span>未付款订单</span></li>
                            <li class="last <?php if(Request::has('p')): ?> active <?php endif; ?>"><span>资金记录</span></li>
                            <div class="clear"></div>
                        </ul>

                        <div class="MoneyBox">
                            <div class="PageBox QK" id="QK">
                                <div class="Table">
                                    <div class="Th">
                                        <span class="MoneyNum">订单编号</span>
                                        <span class="MoneySitu">订单状态</span>
                                        <span class="MoneyTotal">订单价格</span>
                                        <span class="MoneyMSitu">款项状态</span>
                                        <span class="MoneyTime">提交时间</span>
                                        <div class="clear"></div>
                                    </div>

                                 <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="Td">
                                            <span class="MoneyNum"><a href="<?php echo e(route('orders.edit',$order->id)); ?>"><?php echo e($order->serial_number); ?></a></span>
                                            <span class="MoneySitu"><?php echo e($parameters['order_status'][$order->order_status]); ?></span>
                                            <span class="MoneyTotal">+ <?php echo e($order->total_prices); ?>.00元</span>
                                            <span class="MoneyMSitu"><?php echo e($parameters['payment_status'][$order->payment_status]); ?></span>
                                            <span class="MoneyTime"><?php echo e($order->created_at->format('Y-m-d')); ?></span>
                                            <div class="clear"></div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="Td">
                                                <span class="MoneyInfo">没有欠款订单</span>
                                                <div class="clear"></div>
                                            </div>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <!--  欠款订单 结束  -->
                            <div id="log" class="PageBox JL">
                                <!--  欠款订单 结束  -->
                                <div class="Table">
                                    <div class="Th">
                                        <span class="MoneyType">交易类型</span>
                                        <span class="MoneyNum">交易金额</span>
                                        <span class="MoneyTime">交易时间</span>
                                        <span class="MoneyInfo">信息备注</span>
                                        <div class="clear"></div>
                                    </div>
                                   <?php $__empty_1 = true; $__currentLoopData = $financial_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $financial_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="Td">
                                            <span class="MoneyType">
                                                <?php if($financial_detail->type == 'deposit'): ?>
                                                    存入
                                                <?php elseif($financial_detail->type == 'pay'): ?>
                                                    支付
                                                <?php else: ?>
                                                    定金
                                                <?php endif; ?></span>
                                            <span class="MoneyNum"><?php echo e($financial_detail->price); ?>.00元</span>
                                            <span class="MoneyTime"><?php echo e($financial_detail->created_at); ?></span>
                                            <span class="MoneyInfo"><?php echo e($financial_detail->comment); ?></span>
                                            <div class="clear"></div>
                                        </div>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="Td">
                                            <span class="MoneyInfo">没有资金记录</span>
                                            <div class="clear"></div>
                                        </div>
                                   <?php endif; ?>
                                </div>
                                <?php echo $financial_details->appends(array_prepend(Request::except('page'),'QK','p'))->render(); ?>

                            </div>


                            <!--  资金记录 结束  -->
                        </div>
                    </div>
                </div>

            </div>
