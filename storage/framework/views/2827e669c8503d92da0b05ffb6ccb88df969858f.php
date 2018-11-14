
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create we_chat_application_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.we_chat_application_managements.create')); ?>">添加应用</button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="we_chat_application_managements">
            <table class="listTable">
                <tr>
                    <th class="">应用ID</th>
                    <th  class="tableInfoDel">应用名</th>
                    <th class="">应用secret</th>
                    <th class="">关联群组</th>
                    <th class="">操作</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $we_chat_application_managements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $we_chat_application_management): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>
                        <td class=""><?php echo e($we_chat_application_management->agentId); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.we_chat_application_managements.edit',$we_chat_application_management->id)); ?>"><?php echo e($we_chat_application_management->name); ?></a></td>
                        <td class=""><?php echo e($we_chat_application_management->secret); ?></td>
                        <td class="">
                            <?php if(!empty($we_chat_application_management->group_chat_array)): ?>
                            <?php $__empty_2 = true; $__currentLoopData = $we_chat_application_management->group_chat_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arrayKey=>$group_chat_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                群聊Id：<?php echo e($arrayKey); ?> &nbsp; &nbsp;&nbsp; 群聊名：<?php echo e($group_chat_array); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                            <td><div class='error'>没有群聊</div></td>
                            <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td class="">
                            <?php if(!empty($we_chat_application_management->group_chat_array)): ?>
                                --
                                <?php else: ?>
                                <a class="changeWeb" data_url="<?php echo e(route('admin.we_chat_application_managements.show',$we_chat_application_management->id)); ?>">创建群聊</a>
                            <?php endif; ?>


                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($we_chat_application_managements->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>