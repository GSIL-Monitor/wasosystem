
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
            <button class="Btn Refresh ">刷新</button>
            <?php if(isset($role) && $role->id !== 1): ?>
            <button type="submit" class="Btn common_add" form_id="roles" location="top" ><?php if(Route::is('admin.roles.create')): ?>添加<?php else: ?>修改<?php endif; ?></button>
            <?php else: ?>
            <button type="submit" class="Btn common_add" form_id="roles" location="top" ><?php if(Route::is('admin.roles.create')): ?>添加<?php else: ?>修改<?php endif; ?></button>
            <?php endif; ?>
            <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.roles.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>