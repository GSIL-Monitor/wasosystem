
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create supplier_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.supplier_managements.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete supplier_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/supplier_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="supplier_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">简称</th>
                    <th class="">简码</th>
                    <th class="">采购总数</th>
                    <th class="">退货数(率)</th>
                    <th class="">返修数(率)</th>
                    <th class="">操作人员</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $supplier_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($supplier_management->id); ?>"></td>
                        <td class="tablePhoneShow  tableName"><a class="changeWeb" data_url="<?php echo e(route('admin.supplier_managements.edit',$supplier_management->id)); ?>"><?php echo e($supplier_management->name); ?></a></td>
                        <td class=""><?php echo e($supplier_management->code); ?></td>
                        <td class="">
                            <?php echo e($supplier_management->numberPurchasing()); ?>

                        </td>
                        <td><?php echo e($supplier_management->sales_return_count); ?>  / <?php echo e($supplier_management->repairRate()); ?> % </td>
                        <td><?php echo e($supplier_management->factory_return_count); ?> / <?php echo e($supplier_management->returnRate()); ?> % </td>
                        <td class=""><?php echo e($supplier_management->admins->name); ?></td>
                        <td class="tableMoreHide"><?php echo e($supplier_management->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($supplier_management->updated_at->format('Y-m-d')); ?></td>
                        <td class=""><a class="changeWeb" data_url="<?php echo e(route('admin.supplier_repair_addresses.index')); ?>?id=<?php echo e($supplier_management->id); ?>">返修地址</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
                         <?php echo e($supplier_managements->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>