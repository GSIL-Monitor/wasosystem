<div class="p_header">
    <div class="p_logo"><img src="<?php echo e(asset('pic/logo.png')); ?>"></div>
    <div class="P_menu_btn">
        <span class="line1"></span>
        <span class="line2"></span>
        <span class="line3"></span>
    </div>
    <div class="p_person"><a href="   <?php if(auth()->guard('user')->guest()): ?>
        <?php echo e(route('login')); ?>


        <?php else: ?>
        <?php echo e(route('member_center')); ?>

        <?php endif; ?>"><img src="<?php echo e(asset('pic/P_IndexPerson.png')); ?>"></a></div>
    <div class="clear"></div>
</div>
<div class="P_menu">
    <ul>
        <li>产品分类 <i class="Lii">+</i></li>
        <dl>
            <dt>服务器<i>+</i></dt>
            <dd>
                <?php $__currentLoopData = $complete_machine_works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine_work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($complete_machine_work->parent_id == 1): ?>
                        <a href="<?php echo e(route('server.index',$complete_machine_work->id)); ?>"><?php echo e($complete_machine_work->name); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </dd>

            <dt>图形工作站及设计师电脑<i>+</i></dt>
            <dd>
                <?php $__currentLoopData = $complete_machine_works; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine_work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($complete_machine_work->parent_id == 2): ?>
                        <a href="<?php echo e(route('server.index',$complete_machine_work->id)); ?>"><?php echo e($complete_machine_work->name); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </dd>

            <dt>整柜<i>+</i></dt>
            <dd><a href="javascript:void(0)">正在更新中...</a></dd>
        </dl>

        <li>快速选型<i class="Lii">+</i></li>
        <dl>
            <dd style="display: block;">
                <a style="padding-left:20px;" href="<?php echo e(route('server_selection')); ?>">服务器选型</a>
                <a style="padding-left:20px;" href="<?php echo e(route('designer_selection')); ?>">设计师电脑选型</a>
            </dd>
        </dl>

        <li><a class="more_pro" href="<?php echo e(route('in_depth_customization')); ?>">深度定制</a></li>

        <li>解决方案<i class="Lii">+</i></li>
        <dl>
            <?php $__currentLoopData = $integrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $integration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <dt><?php echo e($integration->name); ?><i>+</i></dt>
                <dd>
                <?php $__currentLoopData = $integration->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('solution.show',$child->id)); ?>"><?php echo e($child->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </dd>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </dl>
        <li><a class="more_pro" href="<?php echo e(route('it_outsourcing')); ?>">服务外包</a></li>
        <li><a class="more_pro" href="<?php echo e(route('service_support.index')); ?>">服务支持</a></li>
        <li><a class="more_pro" href="">搜索</a></li>
    </ul>
</div>