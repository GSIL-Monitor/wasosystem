
<?php $OrderParamenterPresenter = app('App\Presenters\OrderParamenterPresenter'); ?>
<?php $__env->startSection('css'); ?>
    <style>
        i {
            width: 15px;
            height: 15px;
            display:inline-block;
            vertical-align: middle;
            margin:0 0 0 5px;
        }
        .UP {

            background: url(<?php echo e(asset('admin/pic/icons.png')); ?>) no-repeat -20px 0;
        }

        .DOWN {
            background: url(<?php echo e(asset('admin/pic/icons.png')); ?>) no-repeat -20px -20px;
        }

        .HOLD {
            background: url(<?php echo e(asset('admin/pic/icons.png')); ?>) no-repeat -20px -40px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit common_equipments')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">批量更新价格</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete common_equipments')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/common_equipments/destory')); ?>">取消常用配置
                    </button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.common_equipments.update_prices')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">配置型号</th>
                    <th class="">订单类型</th>
                    <th class="">配置单价</th>
                    <th class="">更新前</th>
                    <th class="">备注信息</th>
                    <th class="">更新时间</th>
                    <th class="">操作</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $common_equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $common_equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($common_equipment->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.common_equipments.edit',$common_equipment->id)); ?>">
                                <?php echo e($common_equipment->name); ?>

                            </a>
                        </td>
                        <td><?php echo e($common_equipment->machine_model); ?></td>
                        <td><?php echo e($parameters['order_type'][$common_equipment->order_type]); ?></td>
                        <td>
                            <?php echo e($common_equipment->total_prices); ?>

                            <i class="<?php echo e($OrderParamenterPresenter
                                    ->check_peice_float($common_equipment->total_prices,$common_equipment->old_prices)); ?>">
                            </i>
                        </td>
                        <td><?php echo e($common_equipment->old_prices); ?></td>
                        <td><?php echo e($common_equipment->user_remark); ?></td>
                        <td class=""><?php echo e($common_equipment->updated_at->format('Y-m-d')); ?></td>
                        <td><a  class="click" data_title="你确定要下单吗？" data_name="下单" data_url="<?php echo e(route('admin.common_equipments.place_an_order',$common_equipment->id)); ?>">下单</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($common_equipments->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>