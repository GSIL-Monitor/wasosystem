
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create business_managements')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.business_managements.create')); ?>?type=honor">添加</button>
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
                    <th class="tableInfoDel">名称</th>
                    <th class="">缩略图</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                </tr>

                <?php $__empty_1 = true; $__currentLoopData = $honors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $honor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($honor->id); ?>">
                        </td>
                        <td>
                            <input  type="text" name="edit[<?php echo e($honor->id); ?>][sort]" value="<?php echo e($honor->sort); ?>" style="width:40px;">
                        </td>

                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <a class="changeWeb" data_url="<?php echo e(route('admin.business_managements.edit',$honor->id)); ?>?type=honor"><?php echo e($honor->field['name']); ?></a>
                        </td>
                        <td>
                            <img src="<?php echo e(json_decode($honor->pic,true)[0]['url'] ?? asset('admin/pic/personPic.jpg')); ?>" alt="" style="width: 50px;height: 50px">
                        </td>
                        <td class="tableMoreHide"><?php echo e($honor->created_at->format('Y-m-d')); ?></td>
                        <td class=""><?php echo e($honor->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr><td><div class='error'>没有数据</div></td></tr>
                <?php endif; ?>
            </table>
                <?php echo e($honors->links()); ?>

            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>