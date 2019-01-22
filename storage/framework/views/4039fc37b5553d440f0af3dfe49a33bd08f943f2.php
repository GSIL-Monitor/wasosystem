
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="alertWeb Btn" data_url="<?php echo e(route('admin.permissions.create')); ?>">添加权限</button>
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="<?php echo e(url('/waso/permissions/destory')); ?>">删除</button>
            </div>
            <?php echo $__env->make('admin.common._search',[
           'url'=>route('admin.permissions.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'title'=>'权限名',
               'name'=>'权限',
           ]
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form>
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">权限名</th>
                    <th >权限</th>
                </tr>

                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($permission->id); ?>"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="<?php echo e(route('admin.permissions.edit',$permission->id)); ?>"><?php echo e($permission->title); ?></a></td>
                        <td><?php echo e($permission->name); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
                <?php echo e($permissions->links()); ?></form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>