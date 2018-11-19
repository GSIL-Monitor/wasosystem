
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create admins')): ?>
                <button class="alertWeb Btn" data_url="<?php echo e(route('admin.admins.create')); ?>">添加管理员</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit admins')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete admins')): ?>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="<?php echo e(url('/waso/admins/destory')); ?>">删除</button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="admins">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">禁用</th>
                    <th class="tableInfoDel">账号</th>
                    <th class="">角色</th>
                    <th>名称</th>
                    <th>电话</th>
                    <th>邮箱</th>
                    <th>QQ</th>
                    <th>登陆次数</th>
                </tr>
                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <?php if($admin->id !==1): ?>
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($admin->id); ?>">
                                <?php else: ?>
                                --
                                <?php endif; ?>
                        </td>
                        <td>
                            <label for="<?php echo e($admin->id); ?>">
                                <?php echo e(Form::checkbox('edit['.$admin->id.'][disabled]',$admin->disabled,old('edit['.$admin->id.'][disabled]',$admin->disabled),['class'=>'radio','id'=>$admin->id])); ?>

                            </label>
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="<?php echo e(route('admin.admins.edit',$admin->id)); ?>"><?php echo e($admin->account); ?></a></td>
                        <td><?php echo e($admin->name); ?></td>
                        <td><?php echo e($admin->roles->implode('title',',')); ?></td>
                        <td><?php echo e($admin->phone); ?></td>
                        <td><?php echo e($admin->email); ?></td>
                        <td><?php echo e($admin->qq); ?></td>
                        <td><?php echo e($admin->login_count); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <?php echo e($admins->links()); ?>

            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>