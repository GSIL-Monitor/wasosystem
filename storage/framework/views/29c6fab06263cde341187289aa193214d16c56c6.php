
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.business_managements.about') || Route::is('admin.business_managements.copyright')): ?>
                    <button type="submit" class="Btn common_add" form_id="business_managements"
                            location="top">保存
                    </button>
                <?php else: ?>
                    <button type="submit" class="Btn common_add" form_id="business_managements"
                            location="top"><?php if(!optional($business_management)->id  || !optional($business_management)->id): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                    <button class="changeWebClose Btn">返回</button>
                <?php endif; ?>

            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php if(Route::is('admin.business_managements.about') ): ?>
                <?php echo $__env->make('admin.business_managements.form.about_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php elseif(Route::is('admin.business_managements.copyright')): ?>
                <?php echo $__env->make('admin.business_managements.form.copyright_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('admin.business_managements.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>