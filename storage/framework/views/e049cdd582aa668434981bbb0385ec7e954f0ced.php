
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>
            <?php if(Request::has('source')): ?>
                <button class="changeWebClose Btn">返回</button>
            <?php endif; ?>
            <?php echo $__env->make('admin.common._search',[
           'url'=>route('admin.old_orders.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'proid'=>'序列号',
               'remarks'=>'公司',
               'userid'=>'用户账号',
           ]
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="old_orders">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">订单序列号</th>
                    <th  class="">用户账号</th>
                    <th  class="">订单模式</th>
                    <th  class="">订单状态</th>
                    <th  class="">订单价格</th>
                    <th  class="">款项状态</th>
                    <th class="">提交时间</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $old_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb" data_url="<?php echo e(route('admin.old_orders.edit',$old_order->id)); ?>"><?php echo e($old_order->proid); ?></a>
                        </td>
                        <td class=""><?php echo e($old_order->userid); ?><?php echo e($old_order->remarks); ?></td>
                        <td class=""><?php echo e($old_order->mode); ?></td>
                        <td class=""><?php echo e(config('status.old_status')[$old_order->prostatus]); ?></td>
                        <td class=""><?php echo e($old_order->totalprice); ?></td>
                        <td class=""><?php echo e(config('status.old_fund')[$old_order->prostatuss] ?? '未付货款'); ?></td>
                        <td class=""><?php echo e($old_order->prodate); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
             <?php echo e($old_orders->appends(Request::except('page'))->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>