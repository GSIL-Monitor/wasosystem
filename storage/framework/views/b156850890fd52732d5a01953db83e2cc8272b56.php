
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_goods')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/product_goods/destory')); ?>?&delete=Trashed">删除
                    </button>
                <?php endif; ?>
                <button type="submit" class="blue Btn AllDel" form="AllDel"
                        data_url="<?php echo e(url('/waso/product_goods/destory')); ?>?&recover=recover">恢复
                </button>

                <button class="Btn alertWebClose ">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.show',$product_id),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">架构类型</th>
                    <th class="">架构系列</th>
                    <th class="">产品型号</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product_good->id); ?>">
                        </td>
                        <td class=""><?php echo e($product_good->framework->name); ?></td>
                        <td class=""><?php echo e($product_good->series->name); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text"  name="edit[<?php echo e($product_good->id); ?>][name]" value="<?php echo e($product_good->name); ?>">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.product_goods.edit',$product_good->id)); ?>"><?php echo e($product_good->name); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <td>
                        <div class="empty">没有数据</div>
                    </td>
                <?php endif; ?>
            </table>
            </form>
            <?php echo e($product_goods->links('vendor.pagination.bootstrap-4',['data'=>'&product_id='.$product_id])); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>