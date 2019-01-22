<div class="pic_news">
    <div class="wrap">
        <div class="news">
            <div class="newTit">
                <h5>最新资讯</h5>
                <a href="<?php echo e(url('/news_gongsi.html')); ?>">查看更多+</a>
            </div>
            <div class="newsPicList">
                <ul>
                    <?php $__currentLoopData = $new_boutiques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new_boutique): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('news.show',$new_boutique->id)); ?>">
                            <div class="newsPic"><img src="<?php echo e(pic($new_boutique->pic)[0]['url'] ?? ''); ?>"></div>
                            <div class="newsName"><?php echo e($new_boutique->name); ?></div>
                            <div class="newsTime"><span><?php echo e($new_boutique->created_at->format('Y-m-d')); ?></span></div>
                            <div class="newsTxt"><?php echo e(str_limit($new_boutique->description,100)); ?></div>
                            <div class="whiteBg"></div>
                        </a>
                    </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="newsList">
                <dl class="newAutoBox"><!--  默认读取 18条 -->
                    <?php $__currentLoopData = $new_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <dd><a href="<?php echo e(route('news.show',$new_list->id)); ?>">【<?php echo e(config('site.index_newType')[$new_list->type]); ?>】<?php echo e($new_list->name); ?></a></dd>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </dl>
            </div>

        </div>

        <div class="friendLinks">
            <dl>
                <dt>友情链接</dt>
                <dd>
                    <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($friend->field['url']); ?>" name="F_news" target="_blank"><?php echo e($friend->field['name']); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </dd>
                <div class="clear"></div>
            </dl>
        </div>

    </div>
</div>