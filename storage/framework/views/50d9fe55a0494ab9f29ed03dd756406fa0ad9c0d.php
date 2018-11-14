
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create business_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.business_managements.create')); ?>?type=job">添加</button>
                <?php endif; ?>
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
                    <th class="tableInfoDel">职位名称</th>
                    <th class="">职位类别</th>
                    <th class="">薪资待遇</th>
                    <th class="">工作地点</th>
                    <th class="">招聘人数</th>
                    <th>过期</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>

                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($job->id); ?>">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.business_managements.edit',$job->id)); ?>?type=job"><?php echo e($job->field['position']); ?></a>
                        </td>
                        <td class=""><?php echo e($job->field['position_type']); ?></td>
                        <td class=""><?php echo e($job->field['salary']); ?></td>
                        <td class=""><?php echo e($job->field['workplace']); ?></td>
                        <td class=""><?php echo e($job->field['recruiting_numbers']); ?></td>
                        <td class="">
                            <label for="show<?php echo e($job->id); ?>">
                                <?php echo e(Form::checkbox('edit['.$job->id.'][field->over]',$job->field['over'],old('edit['.$job->id.'][field->over]',$job->field['over']),['class'=>'radio','id'=>'show'.$job->id])); ?>

                                过期</label>
                        </td>
                        <td class="tableMoreHide"><?php echo e($job->updated_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($job->created_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($jobs->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>