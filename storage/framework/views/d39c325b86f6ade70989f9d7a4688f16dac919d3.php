<?php $DivisionalManagementParamenter = app('App\Presenters\DivisionalManagementParamenter'); ?>
<div id="bing">
    <div class="total">
        <div class="picTotal Add_form">
            <table class="listTable">
                <tr>
                    <th>任务对象</th>
                    <th class="tableInfoDel"><i class="MBI"></i>目标任务<i class="BDI"></i>保底任务<i class="YHI"></i>已回款</th>
                    <th style="text-align: right;">目标任务</th>
                    <th style="text-align: right;">保底任务</th>
                    
                    <th style="text-align: right;">当月销售</th>
                    <th style="text-align: right;">发出未结</th>
                    <th style="text-align: right;">奖惩</th>
                </tr>

                <?php $__currentLoopData = $divisional_management_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divisional_management_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr class="<?php echo e($divisional_management_list->identifying); ?>  parent_<?php echo e($divisional_management_list->id); ?>" data-pid="<?php echo e($divisional_management_list->parent_id); ?>" data-id="<?php echo e($divisional_management_list->id); ?>">
                   <td class="tableInfoDel tablePhoneShow tableName" ><?php echo e($divisional_management_list->name); ?></td>
                   <td class="tableInfoDel" >
                        <div class="JDBox">
                            <span class="goal"><i><?php echo e($DivisionalManagementParamenter->calculation($divisional_management_list->task->goal ?? 0)); ?> </i></span><span class="guaranteed_task"><i><?php echo e($DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0)); ?> </i></span><span class="returned_money"><i><?php echo e($DivisionalManagementParamenter->returned_money($divisional_management_list->admins)); ?></i></span>
                        </div>
                    </td>
                   <td class=""><span class="MBIWords"><?php echo e($DivisionalManagementParamenter->calculation($divisional_management_list->task->goal ?? 0)); ?></span></td>
                   <td class=""><span class="BDIWords"><?php echo e($DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0)); ?></span></td>
                   
                   <td class=""><span class="monthly_sales"><?php echo e($DivisionalManagementParamenter->monthly_sales($divisional_management_list->admins,$year,$mouth)); ?></span></td>
                   <td class=""><span class="outstanding"><?php echo e($DivisionalManagementParamenter->outstanding($divisional_management_list->admins,$year,$mouth)); ?></span></td>

                   <td class=""><span class=""><?php echo e($DivisionalManagementParamenter->RewardsAndPunishment(
                   $divisional_management_list,
                   $DivisionalManagementParamenter->calculation($divisional_management_list->task->guaranteed_task ?? 0),
                   $DivisionalManagementParamenter->returned_money($divisional_management_list->admins)
                   )); ?></span></td>
                   </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>