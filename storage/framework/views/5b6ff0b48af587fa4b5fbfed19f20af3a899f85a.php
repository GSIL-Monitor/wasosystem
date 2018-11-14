
<?php $grade=$visitor_detail->user->grade ?? '';?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create visitor_details')): ?>
                    <button type="submit" class="Btn common_add" form_id="visitor_details"
                            location="top"><?php if(Route::is('admin.visitor_details.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit visitor_details')): ?>
                    <button type="submit" class="Btn common_add" form_id="visitor_details"
                            location="top"><?php if(Route::is('admin.visitor_details.create')): ?>添加<?php else: ?>
                            修改
                        <?php endif; ?></button>
                <?php endif; ?>
                <?php if($grade=='unverified'): ?>
                    
                    <button class="changeWeb Btn"
                            data_url="<?php echo e(route('admin.users.edit',$visitor_detail->user_id)); ?>">认证会员</button>
                <?php endif; ?>
                <?php if($grade=='' && !empty($visitor_detail->id)): ?>
                    
                    <button class="changeWeb Btn"    data_url="<?php echo e(route('admin.demand_managements.create')); ?>?visitor_details_id=<?php echo e($visitor_detail->id); ?>"
                            >生成需求</button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.visitor_details.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>