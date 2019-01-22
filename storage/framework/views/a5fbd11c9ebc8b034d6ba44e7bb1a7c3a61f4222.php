
<?php $__env->startSection('title', $completeMachine->name.'-驱动下载'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/drive_info.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="<?php echo e(route('service_support.index')); ?>">服务支持</a> > <a href="<?php echo e(route('drive.index')); ?>">整机驱动</a>
                > <span><?php echo e($completeMachine->name.'-驱动下载'); ?></span>
            </div>

            <div class="info_box">
                <div class="pro_pic">
                    <img class="lazy" data-original="<?php echo e(order_complete_machine_pic($completeMachine->complete_machine_product_goods) ?? ''); ?>"/>
                    <div class="infos">
                        <h5><?php echo e($completeMachine->name); ?></h5>
                        <a href="<?php echo e(route('server.show',$completeMachine->id)); ?>" target="_blank">查看产品详情</a>
                        <div class="downs">
                            <?php if(auth()->guard('user')->check()): ?>
                                <h6>驱动下载：</h6>
                                <ul>
                                    <?php $__empty_1 = true; $__currentLoopData = drive($completeMachine->complete_machine_product_goods); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li>
                                            <a href="<?php echo e(url('/downloadFile')); ?>?file=<?php echo e($item->file['url']); ?>&name=<?php echo e($item->file['name']); ?>">
                                                <?php echo e($item->file['name']); ?><i></i>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li>
                                            暂时没有驱动！
                                        </li>
                                    <?php endif; ?>
                                    <div class="clear"></div>
                                </ul>
                                <?php else: ?>
                                    <div class="error">请 <a href="<?php echo e(route('login')); ?>" style="color: #0187CE">登录</a>
                                        后下载！
                                    </div>
                                    <?php endif; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>


            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>