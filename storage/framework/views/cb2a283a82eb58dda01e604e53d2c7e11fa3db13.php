<div class="LeftLinks">

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("website system")): ?>

        <?php $__currentLoopData = $nav['WebMenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$navs['url'])): ?>
                <dl sys="<?php echo e($navs->cats); ?>">
                    <dt><span class=""></span><?php echo e($navs->name); ?><i></i></dt>
                    <div class="linksHide">
                        <?php $childMenus=$navs->childMenus;?>
                        <?php if(count($childMenus) >0): ?>
                            <?php $__currentLoopData = $childMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$childMenu->slug)): ?>
                                    <dd>
                                        <a sys="web" href="javascript:;" class="<?php echo e($childMenu->slug); ?>"
                                           name="<?php echo e($childMenu->slug); ?>"
                                           pagelink="<?php echo e(route($childMenu->url)); ?>"><?php echo e($childMenu->name); ?></a>
                                    </dd>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </dl>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("barcode system")): ?>
            <?php $__currentLoopData = $nav['TiaoMenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$navs['url'])): ?>
                <dl sys="<?php echo e($navs->cats); ?>">
                    <dt><span class=""></span><?php echo e($navs->name); ?><i></i></dt>
                    <div class="linksHide">
                        <?php $childMenus=$navs->childMenus;?>
                        <?php if(count($childMenus) >0): ?>
                            <?php $__currentLoopData = $childMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show '.$childMenu->slug)): ?>
                                <dd>
                                    <a sys="tiao" href="javascript:;" class="<?php echo e($childMenu->slug); ?>"
                                       name="<?php echo e($childMenu->slug); ?>"
                                       pagelink="<?php echo e(route($childMenu->url)); ?>"><?php echo e($childMenu->name); ?></a>
                                </dd>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </dl>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

</div>

<div class="copyright">
    <p>网烁综合管理系统 V2.0.1</p>
    <p>成都网烁信息科技有限公司 版权所有</p>
</div>