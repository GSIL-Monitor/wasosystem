
<?php $__env->startSection('content'); ?>
<?php $CompleteMachineFrameworksParamenter = app('App\Presenters\CompleteMachineFrameworksParamenter'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create complete_machine_frameworks')): ?>
                    <button class="OneAdd Btn" data_title="父级" data_parent_id="0"
                             data_url="<?php echo e(route('admin.complete_machine_frameworks.store')); ?>">添加父级</button>
                    <button class="alertWeb Btn"
                             data_url="<?php echo e(route('admin.complete_machine_frameworks.create')); ?>?parent_id=<?php echo e($parent_id); ?>&category=<?php echo e($category); ?>">添加<?php echo e($parent_parameters[$parent_id]); ?><?php echo e(config('status.complete_machine_framework')[$category]); ?></button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complete_machine_frameworks')): ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete complete_machine_frameworks')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/complete_machine_frameworks/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>$parent_parameters,'duiBiCanShu'=>$parent_id,'url'=>route('admin.complete_machine_frameworks.index'),'canshu'=>'parent_id'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.complete_machine_framework'),'duiBiCanShu'=>$category,'url'=>route('admin.complete_machine_frameworks.index'),'canshu'=>'category','link'=>'&parent_id='.$parent_id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="complete_machine_frameworks">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <?php if($category!='filtrate'): ?>
                    <th class="tableInfoDel">排序</th>
                    <?php endif; ?>
                    <th class="tableInfoDel">参数名</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <?php if($category=='filtrate'): ?>
                    <th >操作</th>
                        <?php endif; ?>
                </tr>
                <?php if($category !='filtrate'): ?>
                <?php $__empty_1 = true; $__currentLoopData = $complete_machine_frameworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complete_machine_framework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($complete_machine_framework->id); ?>">
                        </td>
                        <td class="tableInfoDel"><input type="text" name="edit[<?php echo e($complete_machine_framework->id); ?>][order]"
                                    value="<?php echo e($complete_machine_framework->order); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text"  name="edit[<?php echo e($complete_machine_framework->id); ?>][name]" value="<?php echo e($complete_machine_framework->name); ?>">
                            <a class="alertWeb" data_url="<?php echo e(route('admin.complete_machine_frameworks.edit',$complete_machine_framework->id)); ?>"><?php echo e($complete_machine_framework->name); ?></a>
                        </td>
                        <td class="tableMoreHide"><?php echo e($complete_machine_framework->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($complete_machine_framework->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4"><div class="empty">没有数据</div></td></tr>
                <?php endif; ?>
                    <?php else: ?>
                    <?php echo $CompleteMachineFrameworksParamenter->tree($complete_machine_frameworks,$prefix='',$parent_id); ?>

                <?php endif; ?>
            </table>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>