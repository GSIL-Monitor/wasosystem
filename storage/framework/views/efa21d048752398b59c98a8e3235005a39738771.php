
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create send_messages')): ?>
                    
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete send_messages')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/send_messages/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>['email'=>'邮箱','phone'=>'手机'],'duiBiCanShu'=>$type,'url'=>route('admin.send_messages.index'),'canshu'=>'type'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="send_messages">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class=""> <?php if($type=='email'): ?>发送邮箱号 <?php else: ?> 发送手机号 <?php endif; ?></th>
                    <th  class="tableMoreHide">发送的内容</th>
                    <th class="">发送时间</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $send_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $send_message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($send_message->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <?php echo e($send_message->user->username); ?>      <?php echo e($send_message->user->nickname); ?>

                        </td>
                        <td class="">
                            <?php if($send_message->type=='email'): ?>
                                <?php echo e($send_message->user->email); ?>

                            <?php else: ?>
                                <?php echo e($send_message->user->phone); ?>

                            <?php endif; ?>

                        </td>
                        <td class="tableMoreHide"><?php echo $send_message->content; ?></td>
                        <td class=""><?php echo e($send_message->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($send_messages->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>