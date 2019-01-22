<div id="banner">
    <div class="main_pic">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $pic=json_decode($banner->pic,true); ?>
            <div class="bannerPage " name="<?php echo e($loop->index); ?>" data-ppic="<?php echo e($pic[0]['url'] ?? ''); ?>"
                 data-mpic="<?php echo e($pic[0]['url'] ?? ''); ?>" target="_blank" data-color="<?php echo e($banner['field']['color'] ?? ''); ?>">
                <div class="moveBox"><span class="<?php echo e($banner['field']['font_color'] ?? ''); ?>" data-float="<?php echo e($banner['field']['font_float'] ?? ''); ?>"><em><h5><?php echo e($banner['field']['max_font'] ?? ''); ?></h5><h1><?php echo e($banner['field']['min_font'] ?? ''); ?></h1>
                            <?php if($banner['field']['more'] == '1' && !empty($banner['field']['url'])): ?>
                                <a href="http://<?php echo e($banner['field']['url'] ?? ''); ?>" target="_blank"><i></i><b>了解更多</b></a>
                            <?php endif; ?>
                    </em></span></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="main_point">
        <ul class="whitePoint">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li data-color="<?php echo e($banner['field']['font_color']); ?>" data-number="<?php echo e($loop->index); ?>"><b></b><i></i></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>