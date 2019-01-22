<div id="p_newsheader">
    <a class="goBack"><img onClick="javascript:window.history.back(-1);" src="<?php echo e(asset('pic/P_backB.png')); ?>"></a>
    <h5>新闻资讯</h5>
    <a class="goIndex radius" href="/">网烁首页</a>
</div>
<!--  手机端  通用页头  -->

<div id="news_header">
    <div class="wrap">
        <div class="logo news_logo">
            <a href="/">
                <img src="<?php echo e(asset('pic/logo.png')); ?>"/>
            </a>
        </div>


        <div class="news_user">
            <div class="user">
                <div class="user_login">
                    <?php if(auth()->guard('user')->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>"> <img src="<?php echo e(asset('pic/login_btn.png')); ?>"> </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('member_center')); ?>"><img src="<?php echo e(asset('pic/logined_btn.png')); ?>"> </a>
                            <?php endif; ?>
                </div>

                <div class="user_box">
                    <i></i>
                    <?php if(auth()->guard('user')->guest()): ?>
                        <a href="" class="registerNow">立即注册</a>
                        <a href="<?php echo e(route('login')); ?>">立即登录</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('member_center')); ?>">个人中心</a>
                            <a href="">我的消息
                                <em class="round">11</em>
                            </a>
                            <a href="<?php echo e(route('orders.index')); ?>">我的订单</a>
                            <a href="<?php echo e(url('/logout')); ?>">退出</a>
                            <?php endif; ?>
                </div>
            </div>

            <div class="search_box">
                <div class="round searchBorder">
                    <input type="text"/>
                    <i>设计师电脑</i>
                    <span href=""><img src="<?php echo e(asset('pic/P_search_black.png')); ?>"></span>
                </div>
                <div class="clear"></div>
            </div>

            <ul class="newsType">
                <?php $__currentLoopData = array_reverse(config('site.news_type_cn')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('/news_'.$key.'.html')); ?>"
                           class="<?php if($type == $key): ?> li2 <?php endif; ?>"><i></i><?php echo e($value); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>


</div>