
<?php $__env->startSection('title',$news_title); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/newsPublic.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/news.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="/">网烁官网</a> <i>></i>
                <?php echo e(config('site.news_type_cn')[$type]); ?>

            </div>
            <ul class="newsType">
                <?php $__currentLoopData = config('site.news_type_cn'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li  ><a href="<?php echo e(url('/news_'.$key.'.html')); ?>" class="<?php if($type == $key): ?> li2 <?php endif; ?>"><i></i><?php echo e($value); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </ul>

            <div class="newsBox ">
                <div class="news_left">
                    <ul class="news_ul">
                      <?php if($news->isEmpty()): ?>
                            <li><span class="empty_word">暂无相关信息</span></li>
                      <?php else: ?>
                          <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('news.show',$new->id)); ?>"  class="c" target="_blank">
                                        <h5 class="newsName"><?php echo e($new->name); ?>

                                            <span class="newsTips">
                                            <?php if($loop->index == 0): ?><i class="newTips">最新</i><?php endif; ?>
                                          <?php $__currentLoopData = array_except($new->marketing,'show'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <?php if($item): ?>
                                               <i class="<?php echo e($key); ?>"><?php echo e(config('status.information_management_marketing')[$key]); ?></i>
                                               <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                            <div class="time"><i class="newsIcon newsTime" title="发布时间"></i><?php echo e($new->created_at); ?><i title="阅读量" class="newsIcon newsRead"></i><?php echo e($new->visits()->count()); ?>阅读</div>
                                        </h5>
                                        <div class="pic lazy" style="background-image: url(<?php echo e(pic($new->pic)[0]['url'] ?? ''); ?>)">
                                        </div>
                                        <div class="words"><p><?php echo e($new->description); ?></p></div>
                                        <div class="readMore">查看更多</div>
                                        <div class="clear"></div>
                                    </a>
                                </li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         <?php endif; ?>
                    </ul>
                    <?php echo $news->appends(Request::except('page'))->render(); ?>

                </div>


                <div class="news_right news_right_abs">
                    <div class="right_wrap">
                        <div class="goodNews">
                            <div class="NRtits"><b>精选文章</b></div>
                            <ul>
                               <?php $__currentLoopData = $choiceness_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choiceness): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('news.show',$choiceness->id)); ?>" target="_blank">
                                            <div class="imgBox "><img class="lazy" data-original="<?php echo e(pic($choiceness->pic)[0]['url'] ?? ''); ?>"></div>
                                            <p><?php echo e($choiceness->name); ?></p>
                                        </a>
                                    </li>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <div class="hotNews">
                            <div class="NRtits"><b>热门资讯</b></div>
                            <ul>
                                <?php $__currentLoopData = $hot_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><i></i><a href="<?php echo e(route('news.show',$hot->id)); ?>" target="_blank" title="<?php echo e($hot->name); ?>"><?php echo e($hot->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <!--  热门新闻  -->

                        <div class="new_ad">
                            <div class="NRtits"><b>最新活动</b></div>
                            <ul>
                                <li><a href=""><img src="<?php echo e(asset('pic/news/ad1.jpg')); ?>"/></a></li>
                                <li><a href=""><img src="<?php echo e(asset('pic/news/ad2.jpg')); ?>"/></a></li>
                            </ul>
                        </div>
                        <!--   广告图册 -->

                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.news.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>