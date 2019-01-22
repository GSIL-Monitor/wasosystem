
<?php $__env->startSection('title','关于我们'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/about.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/about.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 关于我们 > 荣誉资质</div></div>
        <div class="wrap">
            <div class="aboutBox">
                <?php if ($__env->exists('site.abouts.about_link')) echo $__env->make('site.abouts.about_link', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="tab_box">
                    <div class="qualified">
                        <i class="tips">* 如需大图，请联系 <a href="{:U('Online/online')}">在线客服</a></i>
                        <!--  置顶资质  -->
                        <ul class="scroll_pic">
                            <?php $__currentLoopData = $honor_tops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $honor_top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="main_pic">
                                    <div>
                                        <img class="lazy" data-original="<?php echo e(pic($honor_top->pic)[0]['url'] ?? ''); ?>" title="如需大图资料，请联系客服人员！"><h5><?php echo e($honor_top->field['name']); ?></h5>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="clear"></div>
                        </ul>

                        <!--  本年资质  -->
                        <?php $__currentLoopData = $honors->groupBy('field.year'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$honor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h5 class="quaTit now"><?php echo e($key); ?></h5>
                            <ul class="scroll_pic">
                                <?php $__currentLoopData = $honor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="main_pic">
                                        <div>
                                            <img class="lazy" data-original="<?php echo e(pic($item->pic)[0]['url'] ?? ''); ?>" title="如需大图资料，请联系客服人员！"><h5><?php echo e($item->field['name']); ?></h5>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="clear"></div>
                            </ul>
                            <?php if($loop->index == 2) break; ?>;
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!--  去年资质  -->


                        <!--  以往资质  -->
                        <h5 class="quaTit pastYear">更多</h5>
                        <ul class="scroll_pic">
                            <?php $__currentLoopData = $honors->groupBy('field.year'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $honor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->index >=3): ?>
                                        <?php $__currentLoopData = $honor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="main_pic">
                                                <div>
                                                    <img class="lazy" data-original="<?php echo e(pic($item->pic)[0]['url'] ?? ''); ?>" title="如需大图资料，请联系客服人员！"><h5><?php echo e($item->field['name']); ?></h5>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <!-- 资质结束 -->
                </div>
                <!--联系结束 -->
                <div class="clear"></div>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>