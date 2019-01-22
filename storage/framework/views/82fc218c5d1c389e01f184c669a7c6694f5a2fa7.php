
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="Btn" ><?php echo e($user->username); ?> <?php echo e($user->nickname); ?></button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <?php echo $__env->make('admin.common._search',
            ['placeholder'=>'请输入订单号',
            'url'=>route('admin.funds_managements.financial_details').'?user_id='.$user->id,
             'status'=>array_except(Request::all(),['type','keyword','_token','page']),
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="funds_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">交易类型</th>
                    <th  class="">交易金额</th>
                    <th class="">交易时间</th>
                    <th class="">操作人员</th>
                    <th class="tableInfoDel">信息备注</th>
                    <th class="tableMoreHide">信息备注</th>
                </tr>


                <?php $__empty_1 = true; $__currentLoopData = $financial_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $financial_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <?php if($financial_detail->type == 'deposit'): ?>
                                存入
                            <?php elseif($financial_detail->type == 'pay'): ?>
                                支付
                            <?php else: ?>
                                定金
                            <?php endif; ?>
                        </td>
                        <td  class=""><?php echo e($financial_detail->price); ?></td>
                        <td class=""><?php echo e($financial_detail->created_at); ?></td>
                        <td class=""><?php echo e($financial_detail->admin->name); ?></td>
                        <td class="tableInfoDel"><?php echo e(str_limit($financial_detail->comment,50)); ?></td>
                        <td class="tableMoreHide"><?php echo e($financial_detail->comment); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
                <?php echo e($financial_details->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())])); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>