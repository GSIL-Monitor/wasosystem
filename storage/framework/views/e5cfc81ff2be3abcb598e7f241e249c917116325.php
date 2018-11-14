
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create supplier_repair_addresses')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.supplier_repair_addresses.create')); ?>?supplier_managements_id=<?php echo e($supplier_management->id); ?>">添加<?php echo e($supplier_management->name); ?>返修地址</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete supplier_repair_addresses')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/supplier_repair_addresses/destory')); ?>">删除
                    </button>

                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="supplier_repair_addresses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">地址</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $supplier_repair_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier_repair_address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($supplier_repair_address->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.supplier_repair_addresses.edit',$supplier_repair_address->id)); ?>"><?php echo e($supplier_repair_address->name); ?></a>
                        </td>
                        <td class=""><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.supplier_repair_addresses.edit',$supplier_repair_address->id)); ?>"><?php echo e($supplier_repair_address->address); ?></a>
                        </td>
                        <td class="tableMoreHide"><?php echo e($supplier_repair_address->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($supplier_repair_address->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($supplier_repair_addresses->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>