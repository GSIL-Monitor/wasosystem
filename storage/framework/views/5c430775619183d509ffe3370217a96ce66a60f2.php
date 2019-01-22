
<?php $__env->startSection('js'); ?>
    <script>
        function sum_prices() {
            var price=0;
            $(".price").each(function(){
                price+=parseInt($(this).text());
            });
            $('.sum_price').text(price+'.00 元').css("color","red");
        }
        $(function () {
            sum_prices();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns"><button class="Btn Refresh ">刷新</button></div>
            <?php echo $__env->make('admin.common._search',
           ['placeholder'=>'请输入欠款账号',
           'url'=>route('admin.funds_managements.index'),
            'status'=>array_except(Request::all(),['type','keyword','_token','page']),
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
            <div class="PageBtnTxt"><div>本页总计：<span class="sum_price"></span></div></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="funds_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">账号</th>
                    <th  class="">姓名</th>
                    <th class="">单位</th>
                    <th class="">级别</th>
                    <th class="">管理员</th>
                    <th class="">未付款合计(元)</th>
                    <th class="">最后登录时间</th>
                    <th class="">操作</th>
                </tr>


                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $company=$user->user_company->firstWhere('default','=',1);
                        $sum_prices=$user->orders->where('order_status','!=','intention_to_order')->whereIn('payment_status',['pay_first','pay_on_delivery','taobao_pay','payment_days_user','payment_days_user','pay_in_advance'])->sum('total_prices');
                    ?>
                    <tr>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.funds_managements.create')); ?>?user_id=<?php echo e($user->id); ?>"><?php echo e($user->username); ?></a>
                        </td>
                        <td  class=""><?php echo e($user->nickname); ?></td>
                        <td class=""><?php echo e($user->unit ?? $company->name ?? ''); ?></td>
                        <td class=""><?php echo e($user->grades->name); ?></td>
                        <td class=""><?php echo e($user->admins->name ?? ''); ?></td>
                        <td class="price"><?php echo e($sum_prices); ?></td>
                        <td class=""><?php echo e($user->last_login_time ?? ''); ?></td>
                        <td class=""><a class='changeWeb' data_url="<?php echo e(route('admin.funds_managements.financial_details')); ?>?user_id=<?php echo e($user->id); ?>">资金记录</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            <?php echo e($users->links()); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>