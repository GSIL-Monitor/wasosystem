<div class="searchResultPage searchPro">
    <div class="s_product">
        <dl>
            <?php $__currentLoopData = $completeMachines->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <dd>
                    <a href="<?php if($search->parent_id ==1 ): ?>
                            <?php echo e(route('server.show',$search->id)); ?>

                            <?php else: ?>
                             <?php echo e(route('server.designer',$search->id)); ?>

                            <?php endif; ?>
                            ">
                        <div class="pic"><img class="lazy" data-original="<?php echo e(order_complete_machine_pic($search->complete_machine_product_goods)); ?>"></div>
                        <div class="infos">
                            <b>
                                <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name); ?>

                            </b>
                            <p>
                                <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->additional_arguments['product_description']); ?>

                            </p>

                        </div>
                        <div class="clear"></div>
                    </a>
                </dd>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="clear"></div>

                <?php if($completeMachines->count() > 8): ?>
                <div class="more_hide">
                    <?php $__currentLoopData = $completeMachines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->index > 7): ?>
                        <dd>
                            <a href="">
                                <div class="pic"><img class="lazy" data-original="<?php echo e(order_complete_machine_pic($search->complete_machine_product_goods)); ?>">
                                </div>
                                <div class="infos">
                                    <b>
                                        <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name); ?>

                                    </b>
                                    <p>
                                        <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->additional_arguments['product_description']); ?>

                                    </p>
                                </div>
                                <div class="clear"></div>
                            </a>
                        </dd>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                    <i class="noMore">没有更多的结果了</i>
                </div>
                <span class="lookAll">显示更多</span>
            <?php endif; ?>
            <div class="clear"></div>
        </dl>
    </div>
</div>
