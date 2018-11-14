
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create procurement_plans')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.procurement_plans.create')); ?>">采购录入</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete procurement_plans')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/procurement_plans/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
                 'url'=>route('admin.procurement_plans.index'),
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

            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.procurement_plans_status'),'duiBiCanShu'=>$status,'url'=>route('admin.procurement_plans.index'),'canshu'=>'status' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="procurement_plans">
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

                <?php $__empty_1 = true; $__currentLoopData = $procurement_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procurement_plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($procurement_plan->id); ?>">
                        </td>
                        <td><?php echo e(config('status.procurement_plans_type')[$procurement_plan->procurement_type]); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.procurement_plans.edit',$procurement_plan->id)); ?>"><?php echo e($procurement_plan->serial_number); ?></a>
                        </td>
                        <td><?php echo e($procurement_plan->supplier_managements->name); ?></td>
                        <td><?php echo e($procurement_plan->products->title); ?></td>
                        <td><?php echo e($procurement_plan->product_goods->name); ?></td>
                        <td><?php echo e($procurement_plan->procurement_number); ?></td>
                        <td><span class="<?php if($procurement_plan->procurement_status =='procurement'): ?> redWord <?php else: ?> greenWord <?php endif; ?>"><?php echo e(config('status.procurement_plans_statuss')[$procurement_plan->procurement_status]); ?></span></td>
                        <td><?php echo e($procurement_plan->purchases->name ?? ''); ?></td>
                        <td><?php echo e($procurement_plan->logistics_company ?? ''); ?><?php echo e($procurement_plan->logistics_number ?? ''); ?></td>
                        <td class="tableMoreHide"><?php echo e($procurement_plan->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($procurement_plan->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            <?php echo e($procurement_plans->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())])); ?>


            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>