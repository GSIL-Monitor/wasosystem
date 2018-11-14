
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create put_in_storage_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.put_in_storage_managements.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete put_in_storage_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/put_in_storage_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
               'url'=>route('admin.put_in_storage_managements.index'),
               'status'=>array_except(Request::all(),['type','keyword','_token']),
               'condition'=>[
                   'serial_number'=>'序列号',
                   'supplier_managements_id'=>'供货单位/简称',
                    'product_good_id'=>'产品名/简称',

               ]
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="put_in_storage_managements">
                <table class="listTable">
                    <tr>
                        <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                        <th class="">类别</th>
                        <th class="tableInfoDel">预购序列号</th>
                        <th class="">供货单位</th>
                        <th class="">产品类型</th>
                        <th class="">产品规格</th>
                        <th class="">数量</th>
                        <th class="">状态</th>
                        <th class="">采购员</th>
                        <th class="">物流及单号</th>
                        <th  class="tableMoreHide">预购日期</th>
                        <th class="">修改时间</th>

                    </tr>

                    <?php $__empty_1 = true; $__currentLoopData = $put_in_storage_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $put_in_storage_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="tableInfoDel">
                                <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($put_in_storage_management->id); ?>">
                            </td>
                            <td><?php echo e(config('status.procurement_plans_type')[$put_in_storage_management->procurement_type]); ?></td>
                            <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                                   data_url="<?php echo e(route('admin.put_in_storage_managements.edit',$put_in_storage_management->id)); ?>"><?php echo e($put_in_storage_management->serial_number); ?></a>
                            </td>
                            <td><?php echo e($put_in_storage_management->supplier_managements->name); ?></td>
                            <td><?php echo e($put_in_storage_management->products->title); ?></td>
                            <td><?php echo e($put_in_storage_management->product_goods->name); ?></td>
                            <td><?php echo e($put_in_storage_management->procurement_number); ?></td>
                            <td><span class="<?php if($put_in_storage_management->procurement_status =='procurement'): ?> redWord <?php else: ?> greenWord <?php endif; ?>"><?php echo e(config('status.procurement_plans_statuss')[$put_in_storage_management->procurement_status]); ?></span></td>
                            <td><?php echo e($put_in_storage_management->purchases->name ?? ''); ?></td>
                            <td><?php echo e($put_in_storage_management->logistics_company ?? ''); ?><?php echo e($put_in_storage_management->logistics_number ?? ''); ?></td>
                            <td class="tableMoreHide"><?php echo e($put_in_storage_management->created_at->format('Y-m-d')); ?></td>
                            <td class=""><?php echo e($put_in_storage_management->updated_at->format('Y-m-d')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td><div class='error'>没有数据</div></td></tr>
                    <?php endif; ?>
                </table>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>