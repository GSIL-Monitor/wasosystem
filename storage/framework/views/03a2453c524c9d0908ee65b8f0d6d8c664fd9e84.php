
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $(document).on('click','.grades',function () {
                var val=$(this).val();
                if(val == 'all' && $(this).prop('checked')){
                    $('.grades').eq(0).parent('label').find('input').attr('disabled',false)
                    $(this).parent('label').siblings('label').hide().find('input').attr('disabled',true).prop('checked',false);
                }else{
                    $('.grades').eq(0).parent('label').hide().find('input').attr('disabled',true).prop('checked',false);
                   $(this).parent('label').siblings('label').show().find('input').attr('disabled',false)
                }
                $(this).parent('label').siblings('.error').remove()
            });
            $(document).on('keyup','.content',function () {
                var val=$(this).val();
                if(val != '' ){
                    $(this).siblings('.error').remove()
                }else{
                    showError( $(this),'内容不能为空');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.notifications.create')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create notifications')): ?>
                    <button type="submit" class="Btn common_add" form_id="notifications"
                            location="top">添加</button>
                 <?php endif; ?>
                <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit notifications')): ?>
                    <button type="submit" class="Btn common_add" form_id="notifications"
                            location="top">修改</button>
                <?php endif; ?>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.notifications.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>