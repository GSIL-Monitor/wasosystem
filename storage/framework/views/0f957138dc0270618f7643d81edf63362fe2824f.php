
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="alertWeb Btn" data_url="<?php echo e(route('admin.roles.create')); ?>">添加角色</button>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="<?php echo e(url('/waso/roles/destory')); ?>">删除</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">角色名</th>
                    <th >角色</th>
                    <th class="tableMoreHide">权限</th>
                </tr>

                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <?php if($role->id === 1): ?>
                                 --
                                <?php else: ?>
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($role->id); ?>">
                            <?php endif; ?>
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="<?php echo e(route('admin.roles.edit',$role->id)); ?>"><?php echo e($role->title); ?></a></td>
                        <td><?php echo e($role->name); ?></td>
                        <td class="tableMoreHide"><?php echo $role->permissions->implode('title',','); ?>  </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <?php echo e($roles->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>