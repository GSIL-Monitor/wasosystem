<tr>
    <td class="tableInfoDel">
        <?php if($level != 0): ?>
        <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($management->id); ?>">
        <?php else: ?>
         -
        <?php endif; ?>
    </td>
    <td class="tableInfoDel  tablePhoneShow  tableName"
        style='padding-left:<?php echo $level * 10; ?>px !important'>
        <a class="changeWeb" data_url="<?php echo e(route('admin.divisional_managements.edit',$management->id)); ?>">
           <?php echo e($management->name); ?>

        </a>
    </td>
    <td class=""><?php echo e($management->task_mode == 'single' ? '单项模式' : '阶梯模式'); ?></td>
    <td class=""><?php echo e($management->goal); ?></td>
    <td class=""><?php echo e($management->guaranteed_task); ?></td>
    <td class=""><?php echo e($management->award_coefficient); ?></td>
    <td  class="tableMoreHide"><?php echo e($management->task_mode == 'single' ? 0 : $management->goal_two); ?></td>
    <td  class="tableMoreHide"><?php echo e($management->task_mode == 'single' ? 0 : $management->award_coefficient_two); ?></td>
    <td  class="tableMoreHide"><?php echo e($management->task_mode == 'single' ? 0 : $management->goal_three); ?></td>
    <td  class="tableMoreHide"><?php echo e($management->task_mode == 'single' ? 0 : $management->award_coefficient_three); ?></td>
    <td class=""><?php echo e($management->units_index); ?></td>
    <td class=""><?php echo e($management->punish_index); ?></td>
    <td class=""><?php echo e($management->award_index); ?></td>
    <td class="tableMoreHide"><?php echo e($management->created_at->format('Y-m-d')); ?></td>
    <td class=""><?php echo e($management->updated_at->format('Y-m-d')); ?></td>
    <td class="">
       <?php if(empty($management->admin_id)): ?>
       <a class="alertWeb" data_url="<?php echo e(route('admin.divisional_managements.create')); ?>?parent_id=<?php echo e($management->id); ?>">添加下级</a>
       <?php else: ?>
           ----
        <?php endif; ?>
    </td>



</tr>