
<div class="otherServer P_hide" name="otherServer" <?php if($completeMachine->information_management_complete_machines->isEmpty()): ?> style="display: none" <?php endif; ?>>
    <div class="wrap">
        <h6 class="tit">相关资讯</h6>
        <ul class="news">
          <?php $__currentLoopData = $completeMachine->information_management_complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="{:U('/news_'.$v['id'])}">
                        <div class="newsPic"><img alt="" class="lazy"
                                                  data-original="<?php echo e(pic($new->pic)[0]['url']); ?>"></div>
                        <h6><?php echo e($new->name); ?></h6>
                        <span><?php echo e($new->created_at->format('Y-m-d')); ?></span>
                    </a>
                </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="clear"></div>
        </ul>
    </div>
</div>
