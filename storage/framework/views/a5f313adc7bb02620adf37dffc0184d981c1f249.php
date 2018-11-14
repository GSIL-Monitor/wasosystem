
<?php $DivisionalManagementParamenter = app('App\Presenters\DivisionalManagementParamenter'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/progress.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/js/progress.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show historical_task_managements')): ?>
                    <button class="Btn changeWeb" data_url="<?php echo e(route('admin.task_managements.historical_task')); ?>">
                        历史任务
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div class="PersonInfo">

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php echo $DivisionalManagementParamenter->category_tree($divisional_managements,$prefix='',$parent_id,'',''); ?>

                </div>
                <b class="tips">数据仅供参考，请以财务提供数据为准！(涉及价、税分离，订单返利等)</b>
                <?php echo $__env->make('admin.task_managements.table.progress', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>