
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create self_build_terraces')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.self_build_terraces.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete self_build_terraces')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/self_build_terraces/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="self_build_terraces">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                <?php $__currentLoopData = $self_build_terraces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $self_build_terrace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($self_build_terrace->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.self_build_terraces.edit',$self_build_terrace->id)); ?>"><?php echo e($self_build_terrace->name); ?></a>
                        </td>
                        <th class="tableMoreHide"><?php echo e($self_build_terrace->created_at->format('Y-m-d')); ?></th>
                        <td class=""><?php echo e($self_build_terrace->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <?php echo e($self_build_terraces->links()); ?>

            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>