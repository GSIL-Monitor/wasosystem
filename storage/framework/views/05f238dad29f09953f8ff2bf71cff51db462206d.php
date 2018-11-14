<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>我的订单</h5>
                        <p>您可以在这里检索到您要查询的订单。</p>
                    </div>
                    <div class="order_search">

                            <div class="sitUl">
                                <ul>
                                    <li>
                                        <?php $__currentLoopData = config('site.member_center_order_links'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span><a href="<?php echo e(route('orders.index')); ?>?order_status=<?php echo e($key); ?>"  class="<?php if($status == $key ): ?> active <?php endif; ?>"><?php echo e($item); ?></a></span>
                                        <?php if(!$loop->last): ?>
                                                <i class="line">|</i>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="clear"></div>
                                    </li>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                        <?php echo Form::open(['route'=>'orders.index','id'=>'orders','method'=>'GET']); ?>

                            <div class="search_box">
                                <input type="text"name="keyword" placeholder="输入订单号或者关键字" required>
                                <input type="hidden"name="order_status" value="<?php echo e($status); ?>" >
                                <a class="search_btn">搜索</a>
                            </div>
                            <div class="clear"></div>
                        <?php echo Form::close(); ?>


                        <div class="clear"></div>
                    </div>

                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="orderAllTable">
                                <a href="<?php if($item->order_status == 'intention_to_order'): ?><?php echo e(route('orders.show',$item->id)); ?> <?php else: ?> <?php echo e(route('orders.edit',$item->id)); ?> <?php endif; ?>">
                                <div class="Ordertit">
                                    <div class="orderSitInfos">
                                        <span>订单编号：<?php echo e($item->serial_number); ?></span>
                                        <span class="orderSit"><i name="" class=""><?php echo e($parameters['order_status'][$item->order_status]); ?></i></span>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="OrderDetail">
                                    <!--   单个产品   开始 -->
                                    <?php if($item->order_type !='parts'): ?>
                                                <div class="pic">
                                                    <dl>
                                                        <dd>
                                                            <div class="orderPic"><img src="<?php echo e(order_complete_machine_pic($item->order_product_goods)); ?>"></div>
                                                            <div class="proInfoTab">
                                                                <h5 class="canshu"><?php echo e($item->machine_model); ?></h5>
                                                                <h6 class="num">× <?php echo e($item->num); ?></h6>
                                                                <h6 class="prise"><?php echo e($item->total_prices); ?>.00元</h6>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </dd>
                                                        <div class="clear"></div>
                                                    </dl>
                                                </div>
                                        <?php else: ?>
                                        <div class="pic">
                                            <dl>
                                                    <?php $__currentLoopData = $item->order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <dd>
                                                        <div class="orderPic"><img src="<?php echo e(asset('pic/product/'.$item2->product->bianhao.'.png')); ?>"></div>  <!--  订单图片  -->
                                                        <div class="proInfoTab">
                                                            <h5 class="name"><?php echo e($item2->name); ?></h5>                                                         <!--  产品名称  -->
                                                            <!--  产品单价  -->
                                                            <h6 class=num>× <?php echo e($item2->pivot->product_good_num); ?></h6>
                                                        </div>
                                                        <div class="clear"></div>                                                                 <!--  产品数量  -->
                                                    </dd>
                                                    <?php if($key == 1): ?>
                                                        <?php break; ?>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <!--   <dd>一个物料   -->
                                                <div class="clear"></div>
                                            </dl>
                                        </div>
                                    <?php endif; ?>
                                    </if>
                                </div>
                                <div class="orderInfo">
                                    <ul>
                                        <li><div class="orderInfoTit">订单模式：</div><div class="orderInfoContent"><i name="" class="orderType"><?php echo e($parameters['order_type'][$item->order_type]); ?></i></div><div class="clear"></div></li>
                                        <li class="lines">|</li>
                                        <li><div class="orderInfoTit">购买日期：</div><div class="orderInfoContent"><?php echo e($item->created_at); ?>&nbsp;<?php if($status == 'old_orders' ): ?> <simple style="color:red">(旧)</simple> <?php endif; ?></div><div class="clear"></div></li>
                                        <div class="clear"></div>
                                    </ul>
                                </div>
                                <div class="Price">
                                    <span class="MoneyTotal">合计：<i><?php echo e($item->total_prices); ?>.00</i> 元</span>
                                </div>
                                </a>

                                <div class="control">
                                <!--判断是否是老订单-->
                                        <?php if($item->order_status !='intention_to_order'): ?>
                                           <a data_url="<?php echo e(route('orders.copy',$item->id)); ?>" class="Copy">再次购买</a>
                                        <?php else: ?>
                                            <a class="Del" data_url="<?php echo e(url('orders/destory')); ?>" data_id="<?php echo e($item->id); ?>"  data_title="<?php echo e($item->serial_number); ?>">删除订单</a>
                                        <?php endif; ?>
                                        <a href="<?php if($status == 'intention_to_order' ): ?> <?php echo e(route('orders.show',$item->id)); ?> <?php else: ?> <?php echo e(route('orders.edit',$item->id)); ?> <?php endif; ?>" >订单详情</a>
                                    <?php if($item->order_type!='parts'): ?>
                                        <div class="seeMoreBox">
                                            <span class="seeMore">更多</span>
                                            <i></i>
                                            <a data_title="常用配置名" data_parent_id="0" data_product_id="0" data_url="<?php echo e(route('orders.add_common_equipment',$item->id)); ?>" class="OneAdd">设为常用配置</a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!--   单个产品   结束  -->


                    <!--  单个订单表 结束  -->

                    <div id="page"><?php echo e($orders->links()); ?></div>
                </div>

            </div>
