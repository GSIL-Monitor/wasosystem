
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create business_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.business_managements.create')); ?>?type=banner">添加</button>
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
                    <th class="">排序</th>
                    <th class="tableInfoDel">大字</th>
                    <th class="tableMoreHide">小字</th>
                    <th class="">背景色</th>
                    <th class="">链接</th>
                    <th class="tableMoreHide">对齐方向</th>
                    <th class="tableMoreHide">手机端变色</th>
                    <th class="">PC端图片</th>
                    <th class="">手机端图片</th>
                    <th class="">展示更多</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $pics=json_decode($banner->pic,true);?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($banner->id); ?>">
                        </td>
                        
                        <td><input  type="text" name="edit[<?php echo e($banner->id); ?>][sort]" value="<?php echo e($banner->sort); ?>" style="width:40px;"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.business_managements.edit',$banner->id)); ?>?type=banner"><?php echo e($banner->field['max_font']); ?></a>
                        </td>
                        <td class="tableMoreHide"><?php echo e(config('status.banner_font_float')[$banner->field['font_float']]); ?></td>
                        <td class="tableMoreHide"><?php echo e(config('status.banner_font_color')[$banner->field['font_color']]); ?></td>

                        <td><?php echo e($banner->field['color']); ?></td>
                        <td><?php echo e($banner->field['url']); ?></td>

                        <td class="tableMoreHide"><?php echo e($banner->field['min_font']); ?></td>
                        <td><img src="<?php echo e($pics[0]['url'] ?? ''); ?>" alt="" style="height: 100px;"></td>
                        <td><img src="<?php echo e($pics[1]['url'] ?? ''); ?>" alt="" style="height: 100px;"></td>
                       <td> <?php echo Form::checkbox("edit[{$banner->id}][field->more]",$banner->field['more'],old("edit[{$banner->id}][field->more]",$banner->field['more']),['class'=>'radio']); ?></td>
                        <td class="tableMoreHide"><?php echo e($banner->updated_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($banner->created_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
            </form>
             <?php echo e($banners->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>