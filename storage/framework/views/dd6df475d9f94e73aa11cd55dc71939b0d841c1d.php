
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/js/code.js')); ?>"></script>
    <script>
        $(function () {
            $(document).on('change','.product',function () {
                filtrate($(this),"<?php echo e(route('admin.procurement_plans.get_goods')); ?>")
            })
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.procurement_plans.create')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create procurement_plans')): ?>
                    <button type="submit" class="Btn common_add" form_id="procurement_plans"
                            location="top">添加</button>
                 <?php endif; ?>
                    <button class="Btn changeWeb" data_url="<?php echo e(route('admin.supplier_managements.create')); ?>">添加供应商</button>
                    <button  class="Btn changeWeb" data_url="<?php echo e(route('admin.product_goods.index')); ?>?product_id=23&souce=code">添加产品</button>
                <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit procurement_plans')): ?>
                       <?php if( $procurement_plan->procurement_status != 'finish'): ?>
                    <button type="submit" class="Btn common_add" form_id="procurement_plans"
                            location="top">修改</button>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.procurement_plans.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>