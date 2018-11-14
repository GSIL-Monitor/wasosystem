
<?php $DivisionalManagementParamenter = app('App\Presenters\DivisionalManagementParamenter'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/progress.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
     <script src="<?php echo e(asset('admin/js/jq.canvaspercent.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">
                    <?php echo $DivisionalManagementParamenter->chart_tree($divisional_management,$parent_id,$year,$mouth); ?>

                    <dl>
                        <dt>年统计：</dt>
                        <dd>
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.task_managements.marketing_statistics')); ?>?year=<?php echo e($item.array_to_url(\request()->only(['parent_id','mouth']))); ?>"
                                   class="<?php if($year==$item): ?> active <?php endif; ?>"><?php echo e($item); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>月统计：</dt>
                        <dd>
                            <?php $__currentLoopData = $mouths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.task_managements.marketing_statistics')); ?>?year=<?php echo e($year); ?>&mouth=<?php echo e($item.array_to_url(\request()->only(['parent_id']))); ?>" class="<?php if($mouth==$item): ?> active <?php endif; ?>"><?php echo e($item); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                </div>
                <?php echo $__env->make('admin.task_managements.table.chart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>