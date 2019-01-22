
<?php $ServiceManagementParamenter = app('App\Presenters\ServiceManagementParamenter'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/progress.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">
                    <dl>
                        <dt>年份：</dt>
                        <dd>
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.services.repair_statistics')); ?>?year=<?php echo e($item); ?>"
                                   class="<?php if($year==$item): ?> active <?php endif; ?>"><?php echo e($item); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>月份：</dt>
                        <dd>
                            <?php $__currentLoopData = $mouths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.services.repair_statistics')); ?>?year=<?php echo e($year); ?>&mouth=<?php echo e($item); ?>"
                                   class="<?php if($mouth==$item): ?> active <?php endif; ?>"><?php echo e($item); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                </div>
                <b class="tips">数据仅供参考！</b>
            </div>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="services">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel">管理员</th>
                        <th class="">月参与单数</th>
                        <th class="">返修率</th>
                    </tr>
                    <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if(!empty($admin_lists[$key])): ?>
                            <tr>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    <?php echo e($admin_lists[$key]); ?>(<?php echo e($key); ?>)
                                </td>
                                <td class=""><?php echo e($item); ?></td>
                                <td class="">
                                    <?php if(!empty($service_admins[$key])): ?>
                                        <?php echo e(round($service_admins[$key] / $item , 2) * 100); ?>

                                    <?php else: ?>
                                        0
                                    <?php endif; ?>
                                    %
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td>
                                <div class='error'>没有数据</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
                
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>