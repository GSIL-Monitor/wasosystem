
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create it_services')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.it_services.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete it_services')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/it_services/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="it_services">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">架构类型</th>
                    <th class="">产品系列</th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">描述</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                <?php $__currentLoopData = $it_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="<?php echo e($it_service->id); ?>">
                        </td>
                        <td class=""><?php echo e($it_service->framework->name); ?></td>
                        <td class=""><?php echo e($it_service->series->name); ?></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="<?php echo e(route('admin.it_services.edit',$it_service->id)); ?>"><?php echo e($it_service->name); ?> / <?php echo e($it_service->details['cooperation_types']); ?></a>
                        </td>
                        <td class=""><?php echo e($it_service->details['description']); ?></td>
                        <th class="tableMoreHide"><?php echo e($it_service->created_at->format('Y-m-d')); ?></th>
                        <td class=""><?php echo e($it_service->updated_at->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </form>
             <?php echo e($it_services->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>