

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('admin/js/completeMachinesPrice.js')); ?>" type="text/javascript"></script>
    <script>
        $(function () {
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate();
            qrcodeCreate();
        })
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create complete_machines')): ?>
                    <button type="submit" class="Btn common_add" form_id="complete_machines"
                            location="top"><?php if(Route::is('admin.complete_machines.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complete_machines')): ?>
                    <button type="submit" class="Btn common_add" form_id="complete_machines"
                            location="top"><?php if(Route::is('admin.complete_machines.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.complete_machines.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>