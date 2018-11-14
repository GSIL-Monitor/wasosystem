<div class="searchResultPage s_solution s_info searchSol">
    <ul>
        <?php $__currentLoopData = $integrations->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('solution.show',$search->id)); ?>">
                    <div class="pic"><img  class="lazy" src="<?php echo e(json_decode($search->pic,true)[0]['url']); ?>"></div>
                    <div class="infos">
                        <b>
                            <?php echo str_ireplace(Request::get('key'), "<font  style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->name); ?>

                        </b>
                        <p>
                            <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->description); ?>

                        </p>
                        <i class="round time"><?php echo e($search->created_at->format('Y-m-d')); ?></i>
                    </div>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="clear"></div>
            <?php if($integrations->count() > 10): ?>
            <div class="more_hide">
                <?php $__currentLoopData = $integrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->index > 9): ?>
                    <li>
                        <a href="<?php echo e(route('solution.show',$search->id)); ?>">
                            <div class="pic"><img  class="lazy" src="<?php echo e(json_decode($search->pic,true)[0]['url']); ?>"></div>
                            <div class="infos">
                                <b>
                                    <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->name); ?>

                                </b>
                                <p>
                                    <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:20px;font_weight:bold'>".Request::get('key')."</font>",$search->description); ?>

                                </p>
                                <i class="round time"><?php echo e($search->created_at->format('Y-m-d')); ?></i>
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
                <i class="noMore">没有更多的结果了</i>
            </div>
            <div class="clear"></div>
            <span class="lookAll" >显示更多</span>
            <?php endif; ?>
        <div class="clear"></div>
    </ul>
</div>
