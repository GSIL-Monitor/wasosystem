<div class="body" id="body_bg">
    <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 个人中心</div></div>
    <div class="wrap">
        <div class="info_box">
            <div class="left">
                <?php echo $__env->make('member_centers.person_links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="right">
                <div class="info">
                    <div class="person_info">
                        <div class="my_info">
                            <div class="name">
                                <div class="P_headPic"><img src="<?php echo e(asset('pic/P_headPic.png')); ?>"></div>
                                <div class="nameBox">
                                    <a href=""><?php echo e(user()->username); ?> <?php echo e(user()->nickname); ?></a>
                                    <h6>您好，欢迎来到个人中心！</h6>
                                    <h6>您一共登陆了 <?php echo e(user()->login_count); ?>  次</h6>
                                    <h6><?php if(user()->last_login_time == '0'): ?>您是第一次登录 <?php else: ?> 最近一次登录时间：<?php echo e(user()->last_login_time); ?> <?php endif; ?></h6>
                                </div>
                                <div class="clear"></div>
                                <img class="headPicBg" src="<?php echo e(asset('pic/person/headPicBg.png')); ?>">
                            </div>

                            <div class="tonggao">
                                <a class="infoMoreBtn" href="<?php echo e(route('notifications.index')); ?>">
                                    <img src="<?php echo e(asset('pic/person/personMsgIcon.png')); ?>">
                                    <span><?php echo e(user()->notification_count); ?></span>
                                    <h5 class="infoTit">我的消息（条）</h5>
                                </a>
                            </div>

                            <div class="MyMoney">
                                <a class="infoMoreBtn" href="">
                                    <img src="<?php echo e(asset('pic/person/personPriceIcon.png')); ?>">
                                    <div class="MoneyBox">
                                        <?php if($debt_price): ?>
                                            <span class="HaveDebt"><b><?php echo e($debt_price); ?></b>.00</span>
                                        <?php else: ?>
                                            <span class="NotDebt">没有欠款</span>
                                        <?php endif; ?>
                                        <h5 class="infoTit">未付货款（元）</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="clear"></div>

                        </div>
                        <!--   个人  -->
                        <div class="clear"></div>
                    </div>

                    <div class="personInfo">
                        <div class="orderTit">我的订单</div>
                        <ul>

                            <li><a href="<?php echo e(route('orders.index')); ?>?order_status=intention_to_order"><img src="<?php echo e(asset('pic/person/yixiang.png')); ?>"><i><?php echo e($intention_to_order_count); ?></i><h5>意向订单</h5></a></li>
                            <li><a href="<?php echo e(route('orders.index')); ?>?order_status=placing_orders"><img src="<?php echo e(asset('pic/person/xiadan.png')); ?>"><i><?php echo e($placing_orders_count); ?></i><h5>下单订货</h5></a></li>
                            <li><a href="<?php echo e(route('orders.index')); ?>?order_status=order_acceptance"><img src="<?php echo e(asset('pic/person/shouli.png')); ?>"><i><?php echo e($order_acceptance_count); ?></i><h5>受理订单</h5></a></li>
                            <li><a href="<?php echo e(route('orders.index')); ?>?order_status=in_transportation"><img src="<?php echo e(asset('pic/person/zaitu.png')); ?>"><i><?php echo e($in_transportation_count); ?></i><h5>在途运输</h5></a></li>
                            <li><a href="<?php echo e(route('orders.index')); ?>?order_status=arrival_of_goods"><img src="<?php echo e(asset('pic/person/chengjiao.png')); ?>"><i><?php echo e($arrival_of_goods_count); ?></i><h5>成交订单</h5></a></li>
                            <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                    </div>



                    <div class="companyInfo">
                        <div class="addrTit">地址管理</div>
                        <ul>
                            <li><a href="<?php echo e(route('user_companies.index')); ?>">企业信息管理<img src="<?php echo e(asset('pic/more_black.png')); ?>"></a></li>
                            <li><a href="<?php echo e(route('user_addresses.index')); ?>">收货地址管理<img src="<?php echo e(asset('pic/more_black.png')); ?>"></a></li>
                            <div class="clear"></div>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <!--   手机端 显示   -->
                    <div class="P_more">
                        <ul>
                            <?php $__currentLoopData = config('site.member_center_links'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($value['image']) && !empty($value['image']) ): ?>
                                        <?php if(user()->parts_buy && $url== 'parts_buy.index'): ?>
                                            <li><a href="<?php echo e(route($url)); ?>" class="<?php if(Route::is($url)): ?> active <?php endif; ?>" ><h5><img src="<?php echo e(asset('pic/'.$value['image'])); ?>"></h5><img class="arrow" src="<?php echo e(config('site.member_center_links_pic')); ?>"></a></li>

                                        <?php else: ?>
                                        <li><a href="<?php if(Route::has($url)): ?> <?php echo e(route($url)); ?>  <?php endif; ?>" class="<?php if(Route::is($url)): ?> active <?php endif; ?>" ><h5><img src="<?php echo e(asset('pic/'.$value['image'])); ?>"><?php echo e($value['name']); ?></h5><img class="arrow" src="<?php echo e(config('site.member_center_links_pic')); ?>"></a></li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="clear"></div>
                        </ul>
                        <a class="Out" href="<?php echo e(url('/logout')); ?>"><h5>退出登录</h5></a>
                    </div>
                    <!--   手机端 显示    结束  -->
                </div>

            </div>

            <div class="clear"></div>
        </div>

    </div>
</div>