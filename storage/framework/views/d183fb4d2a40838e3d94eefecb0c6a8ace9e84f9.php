
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product_goods')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.product_goods.create')); ?>?product_id=<?php echo e($product_id); ?>">添加产品</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_goods')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product_goods')): ?>
                    <button class="alertWeb Btn" data_url="<?php echo e(route('admin.product_goods.show',$product_id)); ?>?product_id=<?php echo e($product_id); ?>">删除管理</button>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/product_goods/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <?php if(Request::has('souce')): ?>
                    <button class="changeWebClose Btn">返回</button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.product_goods.search',['url'=>route('admin.product_goods.index')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.index'),'canshu'=>'product_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="product_goods">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">架构类型</th>
                    <th class="">架构系列</th>
                    <th class="">产品型号</th>
                    <th class=""><a href="<?php echo e(route('admin.product_goods.index')); ?>?product_id=<?php echo e($product_id); ?>&equal=equal">简称</a></th>
                    <th class="tableMoreHide">状态</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
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
                        <td ><input type="text" name="edit[<?php echo e($product_good->id); ?>][jiancheng]"
                                                                                   value="<?php echo e($product_good->jiancheng); ?>">
                        </td>
                        <td class="tableMoreHide">
                            <?php $__currentLoopData = config('status.procuctGoodStatus'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="<?php echo e($key.$product_good->id); ?>">
                                    <?php echo e(Form::checkbox('edit['.$product_good->id.'][status->'.$key.']',$product_good->status[$key],old('edit['.$product_good->id.'][status->'.$key.']',$product_good->status[$key]),['class'=>'radio','id'=>$key.$product_good->id])); ?>

                                    <?php echo e($status); ?></label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="tableMoreHide"><?php echo e($product_good->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($product_good->updated_at->format('Y-m-d')); ?></td>
                        <td class="">
                            <a class="alertWeb" data_url="<?php echo e(route('admin.product_goods.drive',$product_good->id)); ?>">添加驱动</a>
                            <a data_url="<?php echo e(route('admin.product_goods.copy',$product_good->id)); ?>" class="Copy">复制</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty">没有数据</div>
                <?php endif; ?>
            </table>
                <?php echo e($product_goods->appends(array_except(request()->all(),['page']))->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>