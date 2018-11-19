
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/js/create_order.js')); ?>"></script>
    <script>
        $(function () {
            $(document).on('change','.filtrate',function () {
             filtrate($(this),"<?php echo e(route('admin.demand_managements.filtrateList')); ?>")
            })
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.demand_managements.create')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create demand_managements')): ?>
                    <button type="submit" class="Btn common_add" form_id="demand_managements"
                            location="top">添加</button>
                <?php endif; ?>
                    <?php else: ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit demand_managements')): ?>
                    <button type="submit" class="Btn common_add" form_id="demand_managements"
                            location="top">修改 </button>
                        <button class="Btn changeWeb" data_url="<?php echo e(route('admin.demand_managements.show',$demand_management->id)); ?>">生成初步方案 </button>
                        
                        <button class="Btn AllDel"  data_url="<?php echo e(url('/waso/demand_managements/destory')); ?>?delOrder=allDelete&demand_management_id=<?php echo e($demand_management->id); ?>">删除关联订单</button>
                <?php endif; ?>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.demand_managements.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>