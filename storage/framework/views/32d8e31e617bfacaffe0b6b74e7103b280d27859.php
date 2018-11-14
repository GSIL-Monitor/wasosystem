
<?php $__env->startSection('js'); ?>
    <script>
        $(function(){
            $(document).on('click','.default',function () {
                $(this).val(1).prop('checked',true).parents('tr').siblings('tr').find('.default').val(0).prop('checked',false);
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user_companies')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.user_companies.create')); ?>?user_id=<?php echo e(Request::get('user_id')); ?>">添加单位</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user_companies')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user_companies')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/user_companies/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="user_companies">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">序号</th>
                    <th class="tableInfoDel">单位名称</th>
                    <th class="">发票模式</th>
                    <th class="">联系电话</th>
                    <th class="">单位地址</th>
                    <th class="">默认</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $user_companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <?php if(!$user_company->default): ?>
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($user_company->id); ?>">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($user_company->number); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.user_companies.edit',$user_company->id)); ?>"><?php echo e($user_company->name); ?></a>
                        </td>
                        <td class=""><?php echo e($parameters['invoice'][$user_company->tax_mode]); ?></td>
                        <td class=""><?php echo e($user_company->unit_phone); ?></td>
                        <td><?php echo e($user_company->address); ?></td>
                        <td class="">
                            <?php if($user_company->default): ?>
                                <?php $default=1;?>
                            <?php else: ?>
                                <?php $default=0;?>
                            <?php endif; ?>

                            <?php echo e(Form::checkbox('edit['.$user_company->id.'][default]',$default ,old('edit['.$user_company->id.'][default]',$default),['class'=>'default'])); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($user_companies->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>