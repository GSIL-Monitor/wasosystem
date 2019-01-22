<div id="head_black"></div>
<div id="p_header">
    <a><img onclick="javascript:window.history.back(-1);" src="<?php echo e(asset('pic/P_backB.png')); ?>"></a>
    <h5><?php echo $__env->yieldContent('title'); ?></h5>
</div>
<!--  手机端  通用页头  -->

<div id="header" class="order_header">
    <div class="header_line"></div>
    <div class="wrap">
        <div class="logo order_logo">
            <a href="/">
                <img src="<?php echo e(json_decode(getImages(setting('system_logo')),true)[0]['url'] ?? ''); ?>"/>
            </a>
        </div>

        <h5 class="web_title"><a href=""></a></h5>

        <div class="order_user">
            <ul>
                <li><a href="<?php echo e(route('orders.index')); ?>">返回订单列表</a></li>
                <span>|</span>
                <li><a href="<?php echo e(route('member_center')); ?>">个人中心</a></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>