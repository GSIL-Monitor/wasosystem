

<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if($status=='intention_to_order'): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete orders')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/orders/destory')); ?>">删除
                    </button>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(Request::has('source')): ?>
                    <button class="changeWebClose Btn">返回</button>
                <?php endif; ?>

            </div>
            <?php echo $__env->make('admin.common._search',[
            'url'=>route('admin.orders.index'),
            'status'=>array_except(Request::all(),['type','keyword','_token','user_id']),
            'condition'=>[
                'serial_number'=>'订单序列号',
                'user_id'=>'用户账号',
                'market'=>'工号',
                'total_prices'=>'价格',
            ]
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>array_prepend($parameters['order_status'], '全部订单', 'all_orders'),'duiBiCanShu'=>$status,'url'=>route('admin.orders.index'),'canshu'=>'status','link'=>Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :'' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="orders">
            <table class="listTable">
                <tr>
                    <?php if($status=='intention_to_order'): ?>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <?php endif; ?>
                    <th class="tableInfoDel">订单序列号</th>
                    <th  class=""><a href="<?php echo e(route('admin.orders.index')); ?>?status=<?php echo e($status); ?><?php echo e(Request::has('source')? '&'.array_to_url(array_except(Request::all(),['status'])) :''); ?>">用户账号(取消用户)</a></th>
                    <th  class="">型号</th>
                    <th  class="">订单类型</th>
                    <th  class="">订单状态</th>
                    <th  class="">数量</th>
                    <th  class="">总金额</th>
                    <th  class="">款项状态</th>
                    <th  class="">含税状态</th>
                    <th  class="">提交时间</th>
                    <th  class=""><a href="<?php echo e(route('admin.orders.index')); ?>?status=<?php echo e($status); ?>">管理员</a></th>
                    <th class="">操作</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php if($status == 'intention_to_order'): ?>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($order->id); ?>">
                        </td>
                        <?php endif; ?>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.orders.edit',$order->id)); ?>">
                                <?php if($order->created_at == $order->updated_at): ?>
                                <span class="redWord new"><?php echo e($order->serial_number); ?></span>
                                <i class="newOrder"></i>
                                    <?php else: ?>
                                <?php echo e($order->serial_number); ?>

                                <?php endif; ?>
                            </a>
                            <?php  $demand_number=$order->order_demand_management->first();?>
                            <?php if($demand_number): ?><br/>

                            <a class="changeWeb" data_url="<?php echo e(route('admin.demand_managements.edit',$demand_number->id)); ?>">
                               <?php echo e($demand_number->demand_number ?? ''); ?>

                            </a>
                            <?php endif; ?>
                        </td>
                        <td class="tablePhoneShow"><a href="<?php echo e(route('admin.orders.index')); ?>?user_id=<?php echo e($order->user_id); ?>&status=<?php echo e($status); ?><?php echo e(Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :''); ?>"><?php echo e($order->user->username); ?> <?php echo e($order->user->nickname); ?></a></td>
                        <td class=""><?php echo e($order->machine_model); ?></td>
                        <td class=""><?php echo e($parameters['order_type'][$order->order_type]); ?></td>
                        <td class=""><?php echo e($parameters['order_status'][$order->order_status]); ?></td>
                        <td class=""><?php echo e($order->num); ?></td>
                        <td class=""><?php echo e($order->total_prices); ?></td>
                        <td class=""><?php echo e($parameters['payment_status'][trim($order->payment_status)] ?? ''); ?>  </td>
                        <td class=""><?php echo e($parameters['invoice'][$order->invoice_type]); ?></td>
                        <td class=""><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                        <td class=""><a href="<?php echo e(route('admin.orders.index')); ?>?market=<?php echo e($order->user->admins->account); ?>&status=<?php echo e($status); ?><?php echo e(Request::has('source')? array_to_url(array_except(Request::all(),['status'])) :''); ?>"><?php echo e($order->user->admins->name); ?></a></td>
                         <td><a data_url="<?php echo e(route('admin.orders.copy',$order->id)); ?>" class="Copy">复制</a>
                             <?php if($order->order_type!='parts'): ?>
                                 <a data_title="常用配置名" data_parent_id="0" data_product_id="0" data_url="<?php echo e(route('admin.orders.add_common_equipment',$order->id)); ?>" class="OneAdd">常用</a>
                             <?php endif; ?>
                         </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
                <?php echo e($orders->appends(Request::except(['page']))->links()); ?>

            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>