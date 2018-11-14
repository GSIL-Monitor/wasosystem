<div class="right">
    <div class="info">
        <div class="tit bigTit">
            <h5>消息通知</h5>
            <p>您可以在这里查看最新的会员公告等消息。</p>
        </div>

        <div class="tonggao">
            <ul>
              <?php $__empty_1 = true; $__currentLoopData = $user_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="check_read  <?php if($user_notification->pivot->state): ?> read <?php else: ?> noread <?php endif; ?>" data_url="<?php echo e(route('notifications.read',$user_notification->id)); ?>">
                            <div class="headPic">
                                <div class="headImg"><img src="<?php echo e(asset('pic/wasoHead.png')); ?>"></div>
                                <div class="headInfo">
                                    <span class="names">网烁公司</span>
                                    <span class="time"><?php echo e($user_notification->created_at->diffForHumans()); ?></span>
                                </div>
                            </div>

                            <div class="infos">
                                <h5 class="name" >
                                            <?php if($user_notification->pivot->state): ?>
                                                     <i class="radius readed">[已读]</i>
                                            <?php else: ?>
                                                      <i class="radius notRead">未读</i>
                                            <?php endif; ?>
                                        <?php echo e($user_notification->title); ?>

                                </h5>
                                <p><?php echo e($user_notification->content); ?> </p>
                            </div>
                            <div class="clear"></div>
                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    暂时没有消息！
               <?php endif; ?>
            </ul>
        </div>
      <?php echo $user_notifications->links(); ?>

    </div>

</div>