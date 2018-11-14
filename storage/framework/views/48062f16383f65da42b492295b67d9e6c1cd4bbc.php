
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create member_statuses')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.member_statuses.create')); ?>?type=<?php echo e($status); ?>">添加<?php echo e(config('status.userStatus')[$status]); ?></button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit member_statuses')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete member_statuses')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/member_statuses/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.userStatus'),'duiBiCanShu'=>$status,'url'=>route('admin.member_statuses.index'),'canshu'=>'status'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="member_statuses">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class=""><?php echo e(config('status.userStatus')[$status]); ?>标识</th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                <?php $__currentLoopData = $member_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <?php if($member_status->id==1 || $member_status->id==2): ?>
                            --
                            <?php else: ?>
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($member_status->id); ?>">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($member_status->identifying); ?>

                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text" value="<?php echo e($member_status->name); ?>" name="edit[<?php echo e($member_status->id); ?>][name]">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.member_statuses.edit',$member_status->id)); ?>"><?php echo e($member_status->name); ?></a>
                        </td>
                        <th class="tableMoreHide"><?php echo e($member_status->created_at->format('Y-m-d')); ?></th>
                        <td class=""><?php echo e($member_status->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </form>
             <?php echo e($member_statuses->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>