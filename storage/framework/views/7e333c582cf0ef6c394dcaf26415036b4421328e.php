<div class="body">
    <div class="big_pic">
        <div class="surTXT">
            <h5>服务支持</h5>
            <p>整机驱动 / 行业新闻 / 产品服务</p>
        </div>
    </div>
    <div class="sup_box">
        <div class="wrap">
            <ul class="borderFour">
                <li><a href="<?php echo e(route('member_center')); ?>"><img class="lazy" data-original="<?php echo e(asset('pic/support_count.png')); ?>">我的账户</a></li>
                <li><a href="<?php echo e(route('orders.index')); ?>"><img class="lazy" data-original="<?php echo e(asset('pic/support_check.png')); ?>">订单信息查询</a></li>
                <li><a href="<?php echo e(route('service_support.service_clause',41)); ?>"><img class="lazy" data-original="<?php echo e(asset('pic/support_servier.png')); ?>">服务条款</a></li>
                <li><a href="<?php echo e(url('/news_gongsi.html')); ?>" target="_blank"><img class="lazy" data-original="<?php echo e(asset('pic/support_news.png')); ?>">新闻资讯</a></li>
                <li class="last"><a href="<?php echo e(route('service_support.service_clause',43)); ?>"><img class="lazy" data-original="<?php echo e(asset('pic/support_ques.png')); ?>">购买指南</a></li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>

    <div class="drive_box P_hide">
        <div class="wrap">
            <h5 class="Bigtit">驱动下载</h5>
            <ul class="borderFour">
             <?php $__currentLoopData = $complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('drive.index')); ?>"><img class="lazy" data-original="<?php echo e(pic($complete_machine->pic)[0]['url']); ?>"><?php echo e($complete_machine->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>

            <div class="driveBot">
                <a class="bgDiv" href="javascript:;"><span></span><div class="tableDiv"><div class="tdDiv">配件驱动（更新中）</div></div></a>
                <a class="bgDiv right" href="<?php echo e(route('drive.index')); ?>"><span></span><div class="tableDiv"><div class="tdDiv">更多服务器驱动</div></div></a>
                <div class="clear"></div>
            </div>

        </div>
    </div>


    <div class="other_box">
        <div class="wrap">
            <h5 class="Bigtit">联系我们</h5>
            <ul class="borderTwo">
                <li class="MoveLi">
                    <a  name="F_news" class="talkBtn" href="javascript:void(0)"  data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125">
                        <img class="icon lazy" data-original="<?php echo e(asset('pic/online.png')); ?>">
                        <div class="txt">
                            <h5>在线客服</h5>
                            <p>如果您有什么疑问，可以在这里与我们联系。</p>
                        </div>
                        <div class="clear"></div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img class="hideP" src="<?php echo e(asset('pic/weixin_hover.jpg')); ?>">
                        <img class="icon lazy" data-original="<?php echo e(asset('pic/weixin.png')); ?>">
                        <div class="txt">
                            <h5>微信公众号</h5>
                            <p>关注我们，您将在第一时间收到推送。</p>
                        </div>
                        <div class="clear"></div>
                    </a>
                </li>
                <li class="borderTop MoveLi">
                    <a href="http://weibo.com/wasoinfo?refer_flag=1001030201_" target="_blank">
                        <img class="icon lazy" data-original="<?php echo e(asset('pic/sina.png')); ?>">
                        <div class="txt">
                            <h5>新浪微博</h5>
                            <p>在这里您可以了解到更多热门的服务器周边信息。</p>
                        </div>
                        <div class="clear"></div>
                    </a>
                </li>
                <li class="borderTop last MoveLi">
                    <a href="<?php echo e(route('contact')); ?>">
                        <img class="icon lazy" data-original="<?php echo e(asset('pic/addr.png')); ?>">
                        <div class="txt">
                            <h5>联系地址</h5>
                            <p>诚邀您到我们公司实地探访和洽谈业务。</p>
                        </div>
                        <div class="clear"></div>
                    </a>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>



</div>
</div>
