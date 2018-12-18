<?php $complete_machine_paramenter = app('App\Presenters\CompleteMachineParamenter'); ?>
<?php
        $complete_machine_category=$complete_machine_paramenter->complete_machine_category();
        $storage=$complete_machine_paramenter->storage($common_complete_machines);
        $graphic_workstation_designer_computer=$complete_machine_paramenter->graphic_workstation_designer_computer($common_complete_machines);
         $common_complete_machines=$complete_machine_paramenter->complete_machine($common_complete_machines);

?>
<div id="head_black"></div>
<div id="iconbox" class="radius">
    <div class="phonePic">
        <div class="iconInner" id="qrcode"></div>
    </div>
    <h5>手机扫一扫<br>访问移动端</h5>
</div>

<div id="screenControl">
    <ul>
        <li><a href="/"><img src="<?php echo e(asset('pic/P_home.png')); ?>"/>首页</a></li>
        <li><a href="<?php echo e(route('server.index','complete_machine')); ?>"><img src="<?php echo e(asset('pic/P_pro.png')); ?>"/>产品</a></li>
        <li><a href="<?php echo e(route('member_center')); ?>"><img src="<?php echo e(asset('pic/P_person.png')); ?>">我的</a></li>
        <li><a href="<?php echo e(route('service_support.online')); ?>"><img src="<?php echo e(asset('pic/P_online.png')); ?>"/>客服</a></li>
        <div class="clear"></div>
    </ul>
</div>
<!--  手机端  底部按钮  -->

<div id="p_header">
    <a><img onClick="javascript:window.history.back(-1);" src="<?php echo e(asset('pic/P_backB.png')); ?>"></a>
    <h5><?php echo $__env->yieldContent('title','首页'); ?></h5>
</div>
<!--  手机端  通用页头  -->
<div id="header">
    <div class="wrap headWrap ">
        <div class="logo">
            <a href="/"><img src="<?php echo e(json_decode(getImages(setting('system_logo')),true)[0]['url']); ?>"/></a>
        </div>

        <div class="user_control">
            <div class="headPhone">
                <a href="/"><img src="<?php echo e(json_decode(getImages(setting('contact_custome_hotline')),true)[0]['url']); ?>"></a>
            </div>

            <div class="headIcon">
                <span><i title="手机访问"></i></span>
            </div>

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
                    <div class="userLinks">
                        <?php if(auth()->guard('user')->guest()): ?>
                            <a href="<?php echo e(route('register')); ?>" class="registerNow">立即注册</a>
                            <a href="<?php echo e(route('login')); ?>">立即登录</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('member_center')); ?>">个人中心</a>
                                <a href="<?php echo e(route('notifications.index')); ?>">我的消息
                                    <em class="round"><?php echo e(user()->notification_count ?? ''); ?></em>
                                </a>
                                <a href="<?php echo e(route('orders.index')); ?>">我的订单</a>
                                <a href="<?php echo e(url('/logout')); ?>">退出</a>
                                <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="search_box searchClose">
                <div class="round searchBorder">
                    <input type="text" class="search"/>
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

    <div class="wrap">
        <div class="menu">
            <ul class="links">
                <span class="proLinks">
                <li class='hide_pro active'>
                <a class='linka more_pro' href="javascript:;"><i class="activeLine"></i>产品分类</a>
                <div class="choose_bg">
                    <div class="headProType">
                        <div class="wrap">
                            <ul>
                                <li class="active"><span>服务器</span><i></i></li>
                                <li><span>存储</span><i></i></li>
                                <li><span>图形工作站及设计师电脑</span><i></i></li>
                                <li class="lastType"><span>整柜产品</span><i></i></li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="choose_pro">
                        <?php if ($__env->exists('site.layouts.complete_machines.complete_machine')) echo $__env->make('site.layouts.complete_machines.complete_machine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php if ($__env->exists('site.layouts.complete_machines.storage')) echo $__env->make('site.layouts.complete_machines.storage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                         <?php if ($__env->exists('site.layouts.complete_machines.graphic_workstation_designer_computer')) echo $__env->make('site.layouts.complete_machines.graphic_workstation_designer_computer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <dl>
                                <dd>
                                    <div class="proBoxes ZG">
                                      <img src="<?php echo e(asset('pic/zhengG.jpg')); ?>">
                                    </div>
                                </dd>
                                <div class="clear"></div>
                            </dl>
                            <div class="clear"></div>
                        </div>
                    </div>
                    </div>
                    </li>

                    <li class='hide_pro active'>
                   <a class='linka more_pro' href="javascript:;"><i class="activeLine"></i>快速选型</a>
                        <!-- <em class="new"></em>   -->
                   <div class="choose_bg">
                       <div class="wrap">
                           <div class="choose_pro" style="height:inherit;">
                               <ul class="fastLinks">
                                   <li><a class='linka' href="<?php echo e(route('three_major_items')); ?>"><img
                                                   src="<?php echo e(asset('pic/fastLinks3.jpg')); ?>"><h5>服务器三大件性价比指数表</h5><p>从性价比出发，达到综合效率最高</p></a></li>
                                   <li class="mid"><a class='linka' href="<?php echo e(route('server_selection')); ?>"><img
                                                   src="<?php echo e(asset('pic/fastLinks1.jpg')); ?>"><h5>服务器、存储选型</h5><p>快速匹配，随需而选，深度定制</p></a></li>
                                   <li><a class='linka' href="<?php echo e(route('designer_selection')); ?>"><img
                                                   src="<?php echo e(asset('pic/fastLinks2.jpg')); ?>"><h5>图工及设计师电脑选型</h5><p>根据自身需求快速匹配合适配置</p></a></li>
                                   <div class="clear"></div>
                               </ul>
                           </div>
                       </div>
                   </div>
                    </li>
                </span>

                <li class='active'><a class='linka' href="<?php echo e(route('in_depth_customization')); ?>"><i class="activeLine"></i>深度定制</a></li>
                <!-- <em class="hot"></em>-->
                <li class='active'><a class='linka ' href="<?php echo e(route('solution')); ?>"><i class="activeLine"></i>解决方案</a></li>
                <!--    -->
                <li class='active'><a class='linka ' href="<?php echo e(route('it_outsourcing')); ?>"><i
                                class="activeLine"></i>服务外包</a></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
    </div>


</div>