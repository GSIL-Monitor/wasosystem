
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
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user_addresses')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.user_addresses.create')); ?>?user_id=<?php echo e(Request::get('user_id')); ?>">添加物流</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user_addresses')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user_addresses')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/user_addresses/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="user_addresses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">序号</th>
                    <th class="tableInfoDel">收货人</th>
                    <th class="">收货地址</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">默认</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $user_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <?php if(!$user_address->default): ?>
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($user_address->id); ?>">
                             <?php endif; ?>
                        </td>
                        <td><?php echo e($user_address->number); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.user_addresses.edit',$user_address->id)); ?>"><?php echo e($user_address->name); ?></a>
                        </td>
                        <td><?php echo e($user_address->address); ?></td>
                        <th class="tableMoreHide"><?php echo e($user_address->created_at->format('Y-m-d')); ?></th>
                        <td class=""><?php echo e($user_address->updated_at->format('Y-m-d')); ?></td>
                        <td class="">
                            <?php if($user_address->default): ?>
                                <?php $default=1;?>
                                <?php else: ?>
                                <?php $default=0;?>
                            <?php endif; ?>

                            <?php echo e(Form::checkbox('edit['.$user_address->id.'][default]',$default ,old('edit['.$user_address->id.'][default]',$default),['class'=>'default'])); ?>

                        </td>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($user_addresses->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>