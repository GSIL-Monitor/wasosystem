<div class="searchResultPage searchNews">
    <div class="s_news s_info">
        <dl>
            <?php $__currentLoopData = $informationManagements->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <dd>
                    <a href="<?php echo e(route('news.show',$search->id)); ?>">
                        <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold' >".Request::get('key')."</font>",$search->name); ?>

                    </a>
                    <p>
                        <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->description); ?>

                    </p>
                    <i class="round time"><?php echo e($search->created_at->format('Y-m-d')); ?></i>
                </dd>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($informationManagements->count() > 10): ?>
                <div class="more_hide">
                    <?php $__currentLoopData = $informationManagements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->index > 9): ?>
                        <dd>
                            <a href="<?php echo e(route('news.show',$search->id)); ?>">
                                <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name); ?>

                            </a>
                            <p>
                                <?php echo str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->description); ?>

                            </p>
                            <i class="round time"><?php echo e($search->created_at->format('Y-m-d')); ?></i>
                        </dd>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <i class="noMore">没有更多的结果了</i>
                </div>
                <span class="lookAll" >显示更多</span>
          <?php endif; ?>
        </dl>
    </div>
</div>
