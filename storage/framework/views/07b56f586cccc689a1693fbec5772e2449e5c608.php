
<?php $__env->startSection('js'); ?>
    <script>
        $(function(){
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate();
            qrcodeCreate();
            orderMaterialsTaxAndNotTax();
            $(document).on('change','.invoice_type ,.service_status',function () {
                orderTaxAndNotTax()
            })
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create common_equipments')): ?>
                    <button type="submit" class="Btn common_add" form_id="common_equipments"
                            location="top"><?php if(Route::is('admin.common_equipments.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit common_equipments')): ?>
                    <button type="submit" class="Btn common_add" form_id="common_equipments"
                            location="top"><?php if(Route::is('admin.common_equipments.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common_equipments.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>