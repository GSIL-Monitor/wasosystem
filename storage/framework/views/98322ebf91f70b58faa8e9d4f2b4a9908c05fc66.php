<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>成都网烁信息科技有限公司</title>
    <link rel="shortcut icon" href="/public/favicon.ico"/>
    <meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="网烁，超微，英特尔，intel，supermicro，服务器，定制服务器，网吧服务器，高性能运算，多节点，云存储，存储服务器，图形工作站，图工，设计，渲染，视频编辑，至强处理器"/>
    <meta name="description" content="创始于2003年的网烁信息，经过十余年的服务器定制，组装，检验，拥有相当丰富的实战经验。并且成为英特尔铂金级技术合作伙伴，美国超微Supermicro的STAP成员，金士顿产品授权经销商，我们客户遍布全国各地，并且不断的发展壮大中。"/>
    <meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="mobile-agent" content="format=xhtml;url=<?php  echo $_SERVER['REQUEST_URI'];?>">
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/public.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/E404.css')); ?>" />
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-1.7.2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.qrcode.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/public.js')); ?>"></script>
</head>

<body>
<div id="head_black"></div>

<div id="iconbox" class="radius">
    <div class="phonePic"><div class="iconInner" id="qrcode"></div></div>
    <h5>手机扫一扫<br>访问移动端</h5>
</div>


<div id="p_header">
    <a><img onClick="javascript:window.history.back(-1);" src="<?php echo e(asset('pic/P_backB.png')); ?>"></a>
    <h5></h5>
</div>
<!--  手机端  通用页头  -->


<div id="header">
    <div class="wrap headWrap">
        <div class="logo"><a href="/"><img src="<?php echo e(asset('pic/logo.png')); ?>"/></a></div>

        <div class="user_control">
            <div class="headPhone"><a href="<?php echo e(route('contact')); ?>"><img src="<?php echo e(asset('pic/headPhone.png')); ?>"></a></div>
            <div class="headIcon"><span><i title="手机访问"></i></span></div>
            <div class="user"><div title="个人中心" class="user_login"><a href="<?php echo e(route('member_center')); ?>"><img src="<?php echo e(asset('pic/login_btn.png')); ?>"></a></div></div>

            <div class="search_box searchClose">
                <div class="round searchBorder">
                    <input type="text"/>
                    <i>设计师电脑</i>
                    <span><img src="<?php echo e(asset('pic/P_search_black.png')); ?>"></span>
                </div>
                <i class="closeSearch" title="关闭搜索"></i>
                <div class="clear"></div>
            </div>
            <!--  个人中心  -->
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</div>


<div class="body">
    <div class="wrap">
        <div class="errorPic"><img src="<?php echo e(asset('pic/404.png')); ?>"></div>

        <div class="errorLinks">
            <p class="bigP">糟糕，页面不在了！</p>
            <a class="goBack" href="/">返回首页</a>

            <div class="moreLinks">
                <h5 class="tit"><i></i>网烁官网导航</h5>
                <dl>
                    <dt>产品分类</dt>
                    <dd>
                        <?php $__currentLoopData = $complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('server.index',$item->id)); ?>"><?php echo e($item->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </dd>
                </dl>
                <dl>
                    <dt>快速选型</dt>
                    <dd>
                        <a href="<?php echo e(route('server.index','complete_machine')); ?>">服务器、存储选型</a>
                        <a href="<?php echo e(route('server.index','graphic_workstation_designer_computer')); ?>">图工及设计师电脑选型</a>
                        <a href="<?php echo e(route('in_depth_customization')); ?>">深度定制</a>
                        <a href="<?php echo e(route('it_outsourcing')); ?>">IT服务外包</a>
                    </dd>
                </dl>
                <dl>
                    <dt>解决方案</dt>
                    <dd>
                        <?php $__currentLoopData = $common_solutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('solution.show',$item->id)); ?>" name=""><?php echo e($item->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </dd>
                </dl>
                <dl>
                    <dt>关于网烁</dt>
                    <dd>
                        <a href="<?php echo e(route('about')); ?>">公司介绍</a>
                        <a href="<?php echo e(route('honor')); ?>">荣誉资质</a>
                        <a href="<?php echo e(route('contact')); ?>">联系我们</a>
                    </dd>
                </dl>
                <dl>
                    <dt>服务支持</dt>
                    <dd>
                        <a href="<?php echo e(route('service_support.index')); ?>">自助服务</a>
                        <a href="<?php echo e(route('service_support.service_clause',43)); ?>">购买指南</a>
                        <a href="<?php echo e(route('service_support.service_clause',40)); ?>">服务条款</a>
                        <a href="<?php echo e(route('orders.index')); ?>">订单信息查询</a>
                    </dd>
                </dl>
                <dl>
                    <dt>新闻资讯</dt>
                    <dd>
                        <a href="<?php echo e(url('news_gongsi.html')); ?>">网烁新闻</a>
                        <a href="<?php echo e(url('news_hangye.html')); ?>">行业新闻</a>
                        <a href="<?php echo e(url('news_jishu.html')); ?>">技术知识</a>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<!-- 页身 -->



<div data-role="page" class="mobile"></div>



<!-- 共用脚底 -->
<div id="foot">
    <div class="order_foot">
        <div class="wrap">
            <div class="f_down">
                <div class="wrap">
                    <div class="f_d_left">
                        <h5>Copyright © <span class="year"><?php echo e(today()->format('Y')); ?></span> <?php echo e(setting('system_title')); ?> 版权所有</h5>
                        <h5><a href="http://www.miitbeian.gov.cn"><?php echo e(setting('system_website_records')); ?></a></h5>
                        <h5><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none"><img src="<?php echo e(asset('pic/beian.png')); ?>" style="margin-right:3px; vertical-align:middle;"/><?php echo e(setting('system_ministry_public_security_records')); ?></a></h5>
                        <a href="<?php echo e(route('service_support.copyright')); ?>">版权声明</a>
                        <a href="<?php echo e(route('service_support.feedback')); ?>" target="_blank">问题反馈</a>
                    </div>

                    <div class="f_d_right">
                        <ul>
                            <li class="sina">
                                <a name="F_news" href="http://weibo.com/wasoinfo?refer_flag=1001030201_" target="_blank">
                                    <img title="网烁新浪微博" src="<?php echo e(asset('pic/P_sina.png')); ?>"/>
                                </a>
                            </li>
                            <li class="weixin">
                                <img title="网烁公众号" src="<?php echo e(asset('pic/P_weixin.png')); ?>"/>
                                <img class="hidePic" src="<?php echo e(json_decode(getImages(setting('contact_wechat')),true)[0]['url'] ?? ''); ?>"/>
                            </li>
                            <div class="clear"></div>
                        </ul>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>





</body>
</html>
<script language="javascript">
    $("#p_header h5").text("错误页面");

</script>
