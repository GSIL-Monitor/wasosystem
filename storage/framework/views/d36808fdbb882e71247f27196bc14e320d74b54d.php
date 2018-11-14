
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product_frameworks')): ?>
                    <button class="OneAdd Btn" data_title="架构" data_parent_id="0"
                            data_product_id="<?php echo e($product_id); ?>" data_url="<?php echo e(route('admin.product_frameworks.store')); ?>">添加架构</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_frameworks')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_frameworks')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/product_frameworks/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_frameworks.index'),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="product_frameworks">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">参数名称</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="tableInfoDel">操作</th>
                </tr>
                <?php $__currentLoopData = $product_frameworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_framework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($product_framework->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[<?php echo e($product_framework->id); ?>][name]"
                                                                                   value="<?php echo e($product_framework->name); ?>">
                           <?php echo e($product_framework->name); ?>

                        </td>
                        <td class="tableMoreHide"><?php echo e($product_framework->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($product_framework->updated_at->format('Y-m-d')); ?></td>
                        <td>
                            <button class="OneAdd Btn" data_title="系列" data_parent_id="<?php echo e($product_framework->id); ?>"
                                    data_product_id="<?php echo e($product_id); ?>" data_url="<?php echo e(route('admin.product_frameworks.store')); ?>">添加系列</button>
                        </td>
                    </tr>
                    <?php $childFrameworks=$product_framework->Childrens;?>
                    <?php if(count($childFrameworks) >0): ?>
                        <?php $__currentLoopData = $childFrameworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childFramework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="tableInfoDel">
                                    <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($childFramework->id); ?>">
                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[<?php echo e($childFramework->id); ?>][name]"
                                                                                           value="<?php echo e($childFramework->name); ?>">
                                    &nbsp;&nbsp;&nbsp; &nbsp;<?php echo e($childFramework->name); ?>

                                </td>
                                <td class="tableMoreHide"><?php echo e($childFramework->created_at->format('Y-m-d')); ?></td>
                                <td class=""><?php echo e($childFramework->updated_at->format('Y-m-d')); ?></td>
                                <td><a class="alertWeb" data_url="<?php echo e(route('admin.product_frameworks.edit',$childFramework->id)); ?>">添加驱动</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>