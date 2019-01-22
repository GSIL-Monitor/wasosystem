
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create business_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.business_managements.create')); ?>?type=service_directory">添加</button>
                <?php endif; ?>
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete business_managements')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/business_managements/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="business_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">分类</th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>
                    <th class="">展示</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $service_directorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_directory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($service_directory->id); ?>">
                        </td>
                        <td class=""><?php echo e(config('status.service_directory_type')[$service_directory->field['type']]); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.business_managements.edit',$service_directory->id)); ?>?type=service_directory"><?php echo e($service_directory->field['name']); ?></a>
                        </td>


                        <td class="tableMoreHide"><?php echo e($service_directory->updated_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($service_directory->created_at->format('Y-m-d')); ?></td>
                        <td class="">
                            <?php echo Form::checkbox("edit[{$service_directory->id}][top]",$service_directory->top,old("edit[{$service_directory->id}][top]",$service_directory->top),['class'=>'radio']); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($service_directorys->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>