
<?php $__env->startSection('title',$informationManagement->name); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/newsPublic.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/news_info.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/news.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            //  /*  右部资讯固定  */
            var viewH = $(window).height() - 140;
            var divHTop = $(".newsInfoBox").offset().top+20;
            var divH = $(".newsInfoBox").height();
            if(divH < viewH){
                $(".newsInfoBox").css("min-height", viewH + "px");
            }
            $(window).scroll(function(){
                if($(window).scrollTop() >= divHTop){
                    $(".newsInfoBox .news_right").removeClass("news_right_abs").addClass("news_right_fix");
                } else{
                    $(".newsInfoBox .news_right").removeClass("news_right_fix").addClass("news_right_abs");
                }
            });
            $(".other_news li:nth-child(3n)").addClass("last");

        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="/">网烁官网</a> <i>></i>
                <?php echo e(config('site.news_type_cn')[$type]); ?>

                <i>></i>
                <?php echo e($informationManagement->name); ?>

            </div>

            <div class="newsBox newsInfoBox">
                <div class="news_left">
                    <div class="news_box">
                        <h5 class="title">   <?php echo e($informationManagement->name); ?></h5>

                        <div class="wordsTips">
                            <?php $__currentLoopData = array_except($informationManagement->marketing,'show'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item): ?>
                                    <i class="<?php echo e($key); ?>"><?php echo e(config('status.information_management_marketing')[$key]); ?></i>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class='infos'>
                        <span>
                            <i class="newsIcon newsTime"></i><?php echo e($informationManagement->created_at); ?>

                            <div class="phoneCode">
                                <div class="phoneBtn"><i class="newsIcon newsPhone"></i>手机看帖</div>
                                <div class="codeBox"><div class="iconInner" id="qrcode"></div></div>
                            </div>
                        </span>
                            <span class="readNum">
                            <i class="newsIcon newsRead"></i><?php echo e(visits($informationManagement)->count()); ?> 阅读
                            
                        </span>
                            <div class="clear"></div>
                        </div>
                        <div class="content">
                            <?php echo str_replace('src=','class="lazy" data-original=',$informationManagement->content); ?>

                        </div>

                        <div class="weixin">
                            <img src="<?php echo e(asset('pic/weixin_hover.jpg')); ?>">
                            <h5>扫一扫，关注网烁公众号！</h5>
                            <h5>微信搜索“<b>网烁</b>”或“<b>waso-vip</b>”</h5>
                            <div class="weiTeach"><img src="<?php echo e(asset('pic/news/weiTeach.jpg')); ?>"></div>
                        </div>

                        <div class="goBack">
                            <a class="leftBtn" href="/" title="了解更多关于服务器定制 图形工作站 it服务外包"><i></i>网烁首页</a>
                            <a class="rightBtn" href="<?php echo e(url('/news_'.$type.'.html')); ?>" title="了解更多关于服务器定制 图形工作站 it服务外包">新闻列表<i></i></a>
                            <div class="clear"></div>
                        </div>

                        <div class="other_news">
                            <h5>相关推荐</h5>
                            <ul>
                               <?php $__currentLoopData = $recommend_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('news.show',$recommend->id)); ?>"><div class="otherPic"><img class="lazy" data-original="<?php echo e(pic($recommend->pic)[0]['url'] ?? ''); ?>"></div><h5><?php echo e($recommend->name); ?></h5></a></li>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="news_right news_right_abs">
                    <div class="right_wrap">
                        <div class="hotNews">
                            <div class="NRtits"><b>热点资讯</b></div>
                            <ul>
                                <?php $__currentLoopData = $hot_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><i></i><a href="<?php echo e(route('news.show',$hot->id)); ?>" target="_blank" title="<?php echo e($hot->name); ?>"><?php echo e($hot->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.news.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>