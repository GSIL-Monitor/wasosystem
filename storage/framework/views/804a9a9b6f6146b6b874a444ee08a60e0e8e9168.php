
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create products')): ?>
                    <button class="alertWeb Btn" data_url="<?php echo e(route('admin.products.create')); ?>">添加配件</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete products')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/products/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>配件编号</th>
                    <th class="tableInfoDel">配件名</th>
                    <th class="">配件简码</th>
                </tr>

                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product->id); ?>">
                        </td>
                        <td><?php echo e($product->bianhao); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb"
                                                                               data_url="<?php echo e(route('admin.products.edit',$product->id)); ?>"><?php echo e($product->title); ?></a>
                        </td>
                        <td class=""><?php echo e($product->jianma); ?> </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>