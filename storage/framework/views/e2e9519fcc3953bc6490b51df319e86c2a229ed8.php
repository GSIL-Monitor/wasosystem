
<?php $DemandManagementParamenter = app('App\Presenters\DemandManagementParamenter'); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function sum_prices() {
            var chance_price=0,account_paid=0;
            $('.account_paid').each(function () {
                account_paid+=parseInt($(this).text());
            });
            $('.chance_price').each(function () {
                chance_price+=parseInt($(this).text());
            });
            $("#chance_price span").text(chance_price);
            $("#account_paid span").text(account_paid);
        }
        $(function () {
            sum_prices();

        });
        var vm=new Vue({
            el: "#app",
            data:{
                dates:<?php echo json_encode($date); ?>

            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox" id="app">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create demand_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.demand_managements.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show demand_filtrates_users')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.users.index')); ?>?source=demand_managements">会员管理</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete demand_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/demand_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('admin.common._search',[
           'url'=>route('admin.demand_managements.index'),
           'status'=>array_except(Request::all(),['type','keyword','_token']),
           'condition'=>[
               'demand_number'=>'需求序列号',
               'user_id'=>'用户账号',
               'admin'=>'工号',
           ],'select'=>"<date-picker-filtrate :default-date='dates'></date-picker-filtrate>"
           ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
        </div>

        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$parameters['demand_status'],
            'duiBiCanShu'=>$cate,
            'url'=>route('admin.demand_managements.index'),
            'canshu'=>'cate',
            'add'=>[
            'order_history'=>['url'=>route('admin.orders.index').'?status=arrival_of_goods&source=arrival_of_goods','name'=>'历史订单'],
             'old_orders'=>['url'=>route('admin.old_orders.index').'?source=old_order','name'=>'老订单']
            ]
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="demand_managements">
            <table class="listTable">
                <tr>
                    <?php if($cate == 'demand_consult'): ?>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <?php endif; ?>
                    <th class="tableInfoDel">序列号</th>
                    <?php if($cate!='demand_consult'): ?>
                    <th class="">关联订单</th>
                    <?php endif; ?>
                    <th  class="">需求状态</th>
                    <th  class="">用户帐号</th>
                    <th  class="tableMoreHide">联系方式|电话/邮箱/微信/QQ</th>
                    <th  class="tableMoreHide">客户需求</th>
                    <?php if($cate!='demand_consult'): ?>
                    <th  id="chance_price">机会金额 <span></span></th>
                    <th  id="account_paid">成交金额 <span></span></th>
                    <?php endif; ?>
                    <th  class="">客情状态</th>
                    <th  class="tableMoreHide">下步计划</th>
                    <th  class="">添加时间</th>
                    <th class="tableMoreHide">事件更新</th>
                    <th  class="">管理员</th>
                    <th  class="tableMoreHide">协同人员</th>
                    <th  class="">信息来源</th>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $demand_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php if($cate == 'demand_consult'): ?>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($demand_management->id); ?>">
                        </td>
                        <?php endif; ?>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.demand_managements.edit',$demand_management->id)); ?>">
                                <?php if($demand_management->created_at == $demand_management->updated_at): ?>
                                    <span class="redWord new"><?php echo e($demand_management->demand_number); ?></span>
                                    <i class="newOrder"></i>
                                    <?php else: ?>
                                    <?php echo e($demand_management->demand_number); ?>

                                <?php endif; ?>
                            </a>
                        </td>
                        <?php if($cate!='demand_consult'): ?>
                        <td  class="tablePhoneShow"><?php echo $DemandManagementParamenter->orderList($demand_management); ?></td>
                        <?php endif; ?>
                        <td  class=""><?php echo e($parameters['demand_status'][$demand_management->demand_status]); ?></td>
                        <td  class=""><?php echo e($demand_management->user->username ?? ''); ?> <?php echo e($demand_management->user->nickname ?? ''); ?></td>

                        <td  class="tableMoreHide"><?php echo e($demand_management->user->contact ?? ''); ?></td>
                        <td  class="tableMoreHide">
                             <?php echo e($DemandManagementParamenter->customer_demand($demand_management)); ?>

                        </td>
                        <?php if($cate!='demand_consult'): ?>
                        <td  class="chance_price">    <?php echo e($DemandManagementParamenter->orderMaxPrice($demand_management)); ?></td>
                        <td  class="account_paid">    <?php echo e($DemandManagementParamenter->account_paid($demand_management)); ?></td>
                       <?php endif; ?>
                        <td  class="">
                            <?php echo e($parameters['customer_status'][$demand_management->customer_status]); ?>

                        </td>
                        <td  class="tableMoreHide"><?php echo e($demand_management->the_next_step_program); ?></td>
                        <td  class=""><?php echo e($demand_management->created_at->format('Y-m-d')); ?></td>
                        <td class="tableMoreHide"><?php echo e($demand_management->updated_at); ?></td>
                        <td  class=""><?php echo e($parameters['admins'][$demand_management->admin]); ?></td>
                        <td  class="tableMoreHide"> <?php echo e($DemandManagementParamenter->assistant($demand_management)); ?></td>
                        <td  class=""><?php echo e($demand_management->visitor_detail->source ?? '老客户'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
              <?php echo e($demand_managements->links('vendor.pagination.bootstrap-4',['data'=>array_to_url(Request::all())])); ?>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>