
<?php $__env->startSection('title', '驱动下载'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/drive.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">

        <div id="crumbs">
            <div class="wrap"><a href="{:U('Support/support')}">服务支持</a> > <span>整机驱动</span></div>
        </div>

        <div class="wrap">
            <div class="info_box">
                <?php $__empty_1 = true; $__currentLoopData = $complete_machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$complete_machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($key != '0' && $key != ''): ?>
                        <div class="down_list">
                            <h2><i></i><?php echo e($key); ?></h2>
                            <ul>
                                <?php $__empty_2 = true; $__currentLoopData = $complete_machine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <?php if(drive($item->complete_machine_product_goods)->isNotEmpty()): ?>
                                        <li><a class="radius" href="<?php echo e(route('drive.show',$item->id)); ?>"><img
                                                        class="lazy" data-original="<?php echo e(order_complete_machine_pic($item->complete_machine_product_goods)); ?>"/>
                                                <h5><?php echo e($item->name); ?></h5></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <div class="error">
                                        暂时没有驱动
                                    </div>
                                <?php endif; ?>
                                <div class="clear"></div>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>