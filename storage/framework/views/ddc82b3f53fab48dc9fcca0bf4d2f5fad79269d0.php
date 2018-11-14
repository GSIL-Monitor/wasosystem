
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create warehouse_out_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.warehouse_out_managements.code_out')); ?>">条码出库</button>
                <?php endif; ?>

                <?php if($status !='finish'): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete warehouse_out_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/warehouse_out_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
           'url'=>route('admin.warehouse_out_managements.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'serial_number'=>'序列号',
               'user_id'=>'用户账号/姓名',
               'code'=>'条码',
           ]
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.warehouse_out_managements_status'),'duiBiCanShu'=>$status,'url'=>route('admin.warehouse_out_managements.index'),'canshu'=>'status'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="warehouse_out_managements">
            <table class="listTable">
                <tr>
                    <?php if($status !='finish'): ?>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <?php endif; ?>
                    <th class="">类别</th>
                    <th class="tableInfoDel">序列号</th>
                    <th class="">收货单位</th>
                    <th class="">型号</th>
                    <th class="">数量  => 已出</th>
                    <th class="">经办人</th>
                    <th class="">操作人员</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">出库时间</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $warehouse_out_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse_out_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php if($status !='finish'): ?>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($warehouse_out_management->id); ?>">
                        </td>
                        <?php endif; ?>
                        <td><?php echo e(config('status.warehouse_out_managements_type')[$warehouse_out_management->out_type]); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <?php if($status == 'unfinished' && str_is('CK*',$warehouse_out_management->serial_number)): ?>
                            <a class="changeWeb" data_url="<?php echo e(route('admin.warehouse_out_managements.show',$warehouse_out_management->id)); ?>"><?php echo e($warehouse_out_management->serial_number); ?></a>
                            <?php else: ?>
                            <a class="changeWeb" data_url="<?php echo e(route('admin.warehouse_out_managements.edit',$warehouse_out_management->id)); ?>"><?php echo e($warehouse_out_management->serial_number); ?></a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($warehouse_out_management->user->username.' -  '.$warehouse_out_management->user->nickname); ?></td>
                        <td><?php echo e($warehouse_out_management->order->machine_model ?? ''); ?></td>
                        <td><?php echo e($warehouse_out_management->out_number); ?> => <?php echo e($warehouse_out_management->finish_out_number); ?></td>
                        <td><?php echo e($warehouse_out_management->order->markets->name ?? $warehouse_out_management->admins->name ?? ''); ?></td>
                        <td><?php echo e($warehouse_out_management->admins->name ?? ''); ?></td>
                        <td class="tableMoreHide"><?php echo e($warehouse_out_management->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($warehouse_out_management->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            <?php echo $warehouse_out_managements->appends(Request::all())->render(); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>